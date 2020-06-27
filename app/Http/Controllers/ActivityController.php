<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Order;
use App\Repositories\OrderRepositoryInterface;
use App\Transformers\ActivitiyView;
use App\Transformers\CallBackResultArry;
use App\Transformers\FaildActivitiyView;
use App\Transformers\VerifyTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Constraint\Callback;
use Spatie\Fractal\Fractal;


class ActivityController extends Controller
{


    private $calbackUrl;
    public $msg;


    // space that we can use the repository from
    protected $model;

    public function __construct(OrderRepositoryInterface $model)
    {
        $this->calbackUrl = route('callback');
        $this->model = $model;

    }


    /**
     * @return $this
     */
    public function index()
    {


        $paymentAnswerHtml = '';
        $callbackHtml = '';
        $transferToPortHtml = '';
        $callbackResultHtml = '';
        $verifyTansactionHtml = '';

        return view('index')
            ->with(
                [
                    'paymentAnswerHtml' => $paymentAnswerHtml,
                    'transferToPortHtml' => $transferToPortHtml,
                    'callbackHtml' => $callbackHtml,
                    'callbackResultHtml' => $callbackResultHtml,
                    'verifyTansactionHtml' => $verifyTansactionHtml,
                ]
            );
    }


    /**
     * @param $id
     * @return $this
     * @throws \Throwable
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $status = json_decode($order->activities->where('step', 'return')->last()->response)->status;
        if ((int)$status !== 10) {
            $this->get_status_description($status);
            Session::flash('status', $this->msg . "(" . "وضعیت:" . "$status)");
        }

        $activityCreate = $order->activities->where('step', 'create')->last();
        $callbackResult = $order->activities->where('step', 'return')->last();

        $activityCreateArray = Fractal::create()->item($activityCreate, new ActivitiyView())
            ->toArray();


        $paymentAnswerHtml = view('partial.paymentAnswer')->with([
            'activity' => $activityCreateArray['data']['view'],
            'http_code' => $activityCreate->http_code,
        ])->render();


        $transferToPortHtml = view('partial.transferToPort')->with([
            'link' => json_decode($activityCreateArray['data']['view']['response'])->link,
            'order_id' => $order->id,
        ])->render();

        $callbackHtml = view('partial.callback')->with([
            'url' => json_decode($activityCreateArray['data']['view']['response'])->link,
        ])->render();

        $callbackResultArray = Fractal::create()->item($callbackResult->response, new CallBackResultArry())
            ->toArray();

        $callbackResultHtml = view('partial.callbackResult')->with([
            'callbackResult' => $callbackResultArray['data'],
            'step_tome' => $callbackResult->created_at->format('Y-m-d h-m-s'),
            'url' => route('callback'),
        ])->render();


        $verifyTansactionHtml = view('partial.verifyTransaction')->with([
            'callbackResult' => $callbackResult,
            'order_id' => $order->id,
        ])->render();


        return view('show')
            ->with(
                [
                    'paymentAnswerHtml' => $paymentAnswerHtml,
                    'transferToPortHtml' => $transferToPortHtml,
                    'callbackHtml' => $callbackHtml,
                    'callbackResultHtml' => $callbackResultHtml,
                    'verifyTansactionHtml' => $verifyTansactionHtml,
                    'order' => $order,
                ]
            );

    }


    public function header($api_key, $sandbox)
    {

        $header = [
            'Content-Type' => 'application/json',
            "X-API-KEY" => $api_key,
            'X-SANDBOX' => $sandbox
        ];
        return $header;
    }

    public function requestHttp($params, $header, $url)
    {


        $client = new Client();
        $response = $client->request('POST', $url,
            [
                'json' => $params,
                'headers' => $header,
                'http_errors' => false
            ]);

        return $response;

    }


    public function store(Request $request)
    {


        $order = $this->model->create($request->toArray());
        $params = [
            'order_id' => $order->id,
            'amount' => $request->amount,
            'name' => $request->name,
            'phone' => $request->phone_number,
            'mail' => $request->email,
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => $this->calbackUrl,
            'status' => 'processing',
            'reseller' => $request->reseller,
            'API_KEY' => $request->api_key,
            'sandbox' => (int)$request->sandbox,
        ];


        $header = $this->header($request->api_key, $request->sandbox);
        $response = $this->requestHttp($params, $header, 'https://api.idpay.ir/v1.1/payment');


        $activity = [
            'http_code' => $response->getStatusCode(),
            'request' => json_encode($params),
            'response' => $response->getBody(),
            'step' => 'create',

        ];

        $activity = $this->model->createActivity($activity, $order->id);


        if ($response->getStatusCode() == 201) {

            $this->model->update(['return_id' => json_decode($response->getBody())->id], $order->id);

            $activityArray = Fractal::create()->item($activity, new ActivitiyView())
                ->toArray();


            $html = view('partial.paymentAnswer')->with([
                'activity' => $activityArray['data']['view'],
                'http_code' => $response->getStatusCode(),
            ])->render();


            $transferToPortHtml = view('partial.transferToPort')->with([
                'link' => json_decode($activityArray['data']['view']['response'])->link,
                'order_id' => $order->id,

            ])->render();

            return \response()->json(['status' => 'OK', 'paymentAnswer' => $html, 'transferToPort' => $transferToPortHtml, 'message' => '']);


        } else {


            $activityArray = Fractal::create()->item($activity, new FaildActivitiyView())
                ->toArray();
            $html = view('partial.paymentAnswer')->with([
                'activity' => $activityArray['data']['view'],
                'http_code' => $response->getStatusCode(),

            ])->render();

            return \response()->json(['status' => 'ERROR', 'paymentAnswer' => $html, 'message' => '']);

        }


    }


    public function payment(Request $request, $id)
    {

        $order = Order::find($id);
        $activity = [
            'step' => 'redirect',
            'request' => $order->activities->last()->request,
            'response' => json_encode([]),
        ];

        $activity = $this->model->createActivity($activity, $order->id);
        return \response()->json(['status' => 'OK', 'link' => $request->link, 'message' => 'salam khosh amadi']);
    }


    /*
     * after connect in API IDPay return this function
     */
    public function callback(Request $request)
    {

        $activity = array(
            'order_id' => $request['order_id'],
            'step' => 'return',
            'request' => json_encode([]),
            'response' => json_encode($request->all())
        );

        $this->model->createActivity($activity, $request->order_id);
        return redirect()->route('show', $request['order_id']);

    }


    /**
     * @param $status
     * @return string
     */
    public function get_status_description($status)
    {

        switch ($status) {
            case 1:
                $this->msg = 'پرداخت انجام نشده است. ';
                break;
            case 2:
                $this->msg = '.پرداخت ناموفق بوده است';
                break;
            case 3:
                $this->msg = '.خطا رخ داده است';
                break;
            case 4:
                $this->msg = 'بلوکه شده.';
                break;
            case 5:
                $this->msg = 'برگشت به پرداخت کننده.';
                break;
            case 6:
                $this->msg = 'برگشت خورده سیستمی.';
                break;
            case 7:
                $this->msg = 'انصراف از پرداخت.';
                break;
            case 8:
                $this->msg = 'به درگاه پرداخت منتقل شد.';
                break;
            case 10:
                $this->msg = '.در انتظار تایید پرداخت';
                break;
            case 100:
                $this->msg = '.پرداخت تایید شده است';
                break;
            case 101:
                $this->msg = 'پرداخت قبلا تایید شده است.';
                break;

            case 200:
                $this->msg = 'به دریافت کننده واریز شد';
                break;
            case 405:
                $this->msg = 'تایید پرداخت امکان پذیر نیست.';
                break;

        }

    }

    /*
     * connect to verify API IDPay and check double spendding
     */
    public function verify(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        $params = [
            'id' => json_decode($order->activities->where('step', 'create')->last()->response)->id,
            'order_id' => $order->id,
            'API_KEY' => json_decode($order->activities->where('step', 'create')->last()->request)->API_KEY,
            'sandbox' => (int)$order['sandbox'],
        ];

        $header = $this->header(json_decode($order->activities->where('step', 'create')->last()->request)->API_KEY, $order['sandbox']);
        $response = $this->requestHttp($params, $header, 'https://api.idpay.ir/v1.1/payment/verify');


        $activity = [
            'http_code' => $response->getStatusCode(),
            'request' => json_encode($params),
            'response' => $response->getBody(),
            'step' => 'verify',

        ];

        $activity = $this->model->createActivity($activity, $order->id);


        $activityArray = Fractal::create()->item($activity, new VerifyTransformer())
            ->toArray();


        $html = view('partial.verifyResult')->with([
            'response' => $activityArray['data']['view']['response'],
            'request' => $activityArray['data']['view']['request'],
            'http_code' => $response->getStatusCode(),
            'step_time' => $activityArray['data']['view']['step_time'],
        ])->render();

        return \response()->json(['status' => 'OK', 'data' => $html, 'message' => '']);

    }

}
