<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;
use App\Transformers\ActivityView;
use App\Transformers\FailedActivityView;
use App\Transformers\VerifyTransformer;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class ActivityController extends MainController
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $model;

    /**
     * ActivityController constructor.
     * @param OrderRepositoryInterface $model
     */
    public function __construct(OrderRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws GuzzleException
     * @throws Throwable
     */
    public function store(Request $request): JsonResponse
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
        $response = $this->requestHttp($params, $header, '/payment');

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

            $activityArray = ActivityView::transform($activity);
            $html = view('partial.paymentAnswer')->with([
                'activity' => $activityArray['view'],
                'http_code' => $response->getStatusCode(),
            ])->render();

            $link = json_decode($activityArray['view']['response'])->link;
            $transferToPortHtml = view('partial.transferToPort')->with([
                'link' => $link,
                'order_uuid' => $order->uuid,
            ])->render();

            return \response()->json(['status' => 'OK', 'paymentAnswer' => $html, 'link' => $link, 'transferToPort' => $transferToPortHtml, 'message' => 'تراکنش شما ایجاد شد.']);

        } else {

            $activityArray = FailedActivityView::transform($activity);

            $html = view('partial.paymentAnswer')->with([
                'activity' => $activityArray['view'],
                'http_code' => $response->getStatusCode(),

            ])->render();

            return \response()->json(['status' => 'ERROR', 'paymentAnswer' => $html, 'message' => 'تراکنش شما ایجاد نشد.']);
        }
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function payment(Request $request, Order $order): JsonResponse
    {
        $activity = [
            'step' => 'redirect',
            'request' => json_encode($order->activities->last()->request),
            'response' => json_encode([]),
        ];

        $this->model->createActivity($activity, $order->id);

        return \response()->json(['status' => 'OK', 'link' => $request->link, 'message' => 'ممنون از انتخاب شما']);
    }

    /*
     * after connect in API IDPay return this function
     */
    public function callback(Request $request): RedirectResponse
    {
        $order = $this->model->find($request->order_id);
        $CONTENT_TYPE = !empty($request->server->all()['CONTENT_TYPE']) ? $request->server->all()['CONTENT_TYPE'] : 'html/text' ;

        // Add to request
        $request->request->add([
            'CONTENT_TYPE' => $CONTENT_TYPE,
            'REQUEST_METHOD' => $request->method(),
        ]);

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
     * @param Order $order
     * connect to verify API IDPay and check double spending
     * @return JsonResponse
     * @throws GuzzleException
     * @throws Throwable
     */
    public function verify(Order $order): JsonResponse
    {
        $params = [
            'id' => json_decode($order->activities->where('step', 'create')->last()->response)->id,
            'order_id' => $order->id,
            'API_KEY' => $order->activities->where('step', 'create')->last()->request->API_KEY,
            'sandbox' => (int)$order['sandbox'],
        ];

        $header = $this->header($order->activities->where('step', 'create')->last()->request->API_KEY, $order['sandbox']);
        $response = $this->requestHttp($params, $header, '/payment/verify');

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

        $activityArray = VerifyTransformer::transform($activity);

        $http_code = $response->getStatusCode();
        $html = view('partial.verifyResult')->with([
            'response' => $activityArray['view']['response'],
            'request' => $activityArray['view']['request'],
            'http_code' => $http_code,
            'step_time' => $activityArray['view']['step_time'],
            'request_time' => $activityArray['view']['request_time'],
        ])->render();

        return \response()->json(['status' => 'OK', 'data' => $html, 'message' => "کد وضعیت پاسخ: $http_code "]);
    }
}
