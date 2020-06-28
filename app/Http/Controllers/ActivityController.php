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
use Verta;


class ActivityController extends MainController
{


    private $calbackUrl;
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

        return view('index')
            ->with(
                [
                    'paymentAnswerHtml' => '',

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


        $activityCreate = $order->activities->where('step', 'create')->last();
        $redirectResult = $order->activities->where('step', 'redirect')->last();

        $callbackResult = $order->activities->where('step', 'return')->last();

        if ($activityCreate == null or $redirectResult == null)
            return abort(404);


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
            'step_date' => new Verta($redirectResult->created_at),
        ])->render();


        $callbackResultHtml='';
        $verifyTansactionHtml='';
        if ($callbackResult !== null) {
            $status = json_decode($order->activities->where('step', 'return')->last()->response)->status;
            if ((int)$status !== 10) {
                $this->get_status_description($status);
                Session::flash('status', $this->msg . "(" . "وضعیت:" . "$status)");
            }

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

        }


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


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function store(Request $request)
    {


        $order = $this->model->create($request->toArray());
        $params = [
            'order_id' => $order->id,
            'amount' => $request->amount,
            'name' => $request->name,
            'phone' => $request->phone_number,
            'mail' => $request->email,
            'desc' => $request->deck,
            'callback' => $request->callback,
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


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function payment(Request $request, $id)
    {
        $order = Order::find($id);
        $activity = [
            'step' => 'redirect',
            'request' => $order->activities->last()->request,
            'response' => json_encode([]),
        ];

        $this->model->createActivity($activity, $order->id);
        return \response()->json(['status' => 'OK', 'link' => $request->link, 'message' => '']);
    }


    /*
     * after connect in API IDPay return this function
     */
    public function callback(Request $request)
    {

        $CONTENT_TYPE = $request->server->all()['CONTENT_TYPE'];
        $request->request->add(['CONTENT_TYPE' => $CONTENT_TYPE]); //add request

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
     * @param Request $request
     * @param $id
     * connect to verify API IDPay and check double spendding
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
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
