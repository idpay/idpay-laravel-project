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
            'desc' => $request->desc,
            'callback' => $request->callback,
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
            'request_time' => $response->elapsed,
        ];

        $activity = $this->model->createActivity($activity, $order->id);

        if ($response->getStatusCode() == 201) {
            $this->model->update(['return_id' => json_decode($response->getBody())->id], $order->id);

            $activityArray = Fractal::create()->item($activity, new ActivitiyView())->toArray();

            $html = view('partial.paymentAnswer')->with([
                'activity' => $activityArray['data']['view'],
                'http_code' => $response->getStatusCode(),
            ])->render();


            $link = json_decode($activityArray['data']['view']['response'])->link;
            $transferToPortHtml = view('partial.transferToPort')->with([
                'link' => $link,
                'order_id' => $order->id,

            ])->render();

            return \response()->json(['status' => 'OK', 'paymentAnswer' => $html, 'link' => $link, 'transferToPort' => $transferToPortHtml, 'message' => 'تراکنش شما ایجاد شد.']);


        } else {


            $activityArray = Fractal::create()->item($activity, new FaildActivitiyView())->toArray();

            $html = view('partial.paymentAnswer')->with([
                'activity' => $activityArray['data']['view'],
                'http_code' => $response->getStatusCode(),

            ])->render();

            return \response()->json(['status' => 'ERROR', 'paymentAnswer' => $html, 'message' => 'تراکنش شما ایجاد نشد.']);

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
        return \response()->json(['status' => 'OK', 'link' => $request->link, 'message' => 'ممنون از انتخاب شما']);
    }


    /*
     * after connect in API IDPay return this function
     */
    public function callback(Request $request)
    {
        $order = $this->model->find($request->order_id);
        $CONTENT_TYPE = $request->server->all()['CONTENT_TYPE'];
        $request->request->add(['CONTENT_TYPE' => $CONTENT_TYPE]); //add request
        $activity = array(
            'order_id' => $request['order_id'],
            'step' => 'return',
            'request' => json_encode([]),
            'response' => json_encode($request->all())
        );

        $this->model->createActivity($activity, $request->order_id);
        return redirect()->route('show', $order->uuid);

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
            'request_time' => $response->elapsed,

        ];


        $activityModel = $order->activities->where('step', 'verify');
        if ($activityModel->count()) {
            $activity = $activity;
        } else {
            $activity = $this->model->createActivity($activity, $order->id);
        }

        $activityArray = Fractal::create()->item($activity, new VerifyTransformer())->toArray();


        $http_code = $response->getStatusCode();
        $html = view('partial.verifyResult')->with([
            'response' => $activityArray['data']['view']['response'],
            'request' => $activityArray['data']['view']['request'],
            'http_code' => $http_code,
            'step_time' => $activityArray['data']['view']['step_time'],
            'request_time' => $activityArray['data']['view']['request_time'],
        ])->render();


        return \response()->json(['status' => 'OK', 'data' => $html, 'message' => "کد وضعیت پاسخ: $http_code "]);

    }

}
