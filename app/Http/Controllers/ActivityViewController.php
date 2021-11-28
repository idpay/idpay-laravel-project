<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Transformers\ActivityView;
use App\Transformers\CallBackResultArray;
use App\Transformers\VerifyTransformer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class ActivityViewController extends MainController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('index')->with([
            'paymentAnswerHtml' => '',
        ]);
    }

    /**
     * @param $activityCreateArray
     * @param $httpCode
     * @return array|string
     * @throws Throwable
     */
    public function paymentAnswer($activityCreateArray, $httpCode)
    {
        return view('partial.paymentAnswer')->with([
            'activity' => $activityCreateArray['view'],
            'http_code' => $httpCode,
        ])->render();
    }

    /**
     * @param $link
     * @param $uuid
     * @return array|string
     * @throws Throwable
     */
    public function transferToGateway($link, $uuid)
    {
        return view('partial.transferToPort')->with([
            'link' => $link,
            'order_uuid' => $uuid,
        ])->render();
    }

    /**
     * @param $link
     * @param $stepTime
     * @return array|string
     * @throws Throwable
     */
    public function callBack($link, $stepTime)
    {
        return view('partial.callback')->with([
            'url' => $link,
            'step_date' => jdate('Y-m-d H:i:s', $stepTime->timestamp),
        ])->render();
    }

    /**
     * @param $callbackResult
     * @param $stepTime
     * @return array|string
     * @throws Throwable
     */
    public function callBackResult($callbackResult, $stepTime)
    {
        return view('partial.callbackResult')->with(
            [
                'callbackResult' => $callbackResult,
                'step_tome' => jdate('Y-m-d H:i:s', $stepTime->timestamp),
                'url' => route('callback'),
            ]
        )->render();
    }

    /**
     * @param $response
     * @param $request
     * @param $httpCode
     * @param $stepTime
     * @param $request_time
     * @return array|string
     */
    public function verifyResult($response, $request, $httpCode, $stepTime, $request_time)
    {
        return view('partial.verifyResult')->with([
            'response' => $response,
            'request' => $request,
            'http_code' => $httpCode,
            'step_time' => $stepTime,
            'request_time' => $request_time,
        ])->render();
    }

    /**
     * @param Order $order
     * @return Application|Factory|View|void
     * @throws Throwable
     */
    public function show(Order $order)
    {
        $callbackResultHtml = null;
        $verifyResultHtml = null;
        $verifyRequestHtml = null;

        $activityCreate = $order->activities->where('step', 'create')->last();
        $redirectResult = $order->activities->where('step', 'redirect')->last();
        $callbackResult = $order->activities->where('step', 'return')->last();
        $verifyResult = $order->activities->where('step', 'verify')->last();

        if (empty($activityCreate) || empty($redirectResult)) {
            return abort(404);
        }

        $activityCreateArray = ActivityView::transform($activityCreate);

        $paymentAnswerHtml = $this->paymentAnswer($activityCreateArray, $activityCreate->http_code);
        $transferToPortHtml = $this->transferToGateway(json_decode($activityCreateArray['view']['response'])->link, $order->uuid);
        $callbackHtml = $this->callBack(json_decode($activityCreateArray['view']['response'])->link, $redirectResult->created_at);

        if (!empty($callbackResult)) {
            $status = json_decode($order->activities->where('step', 'return')->last()->response)->status;

            if ((int)$status !== 10) {
                $this->get_status_description($status);
                $replaced = Str::replaceLast('استاتوس', $status, "جمله (وضعیت: استاتوس)");
                $replaced = Str::replaceLast('جمله', $this->msg, $replaced);
                Session::flash('status', $replaced);
                toastr()->error($replaced);
            }

            $callbackResultArray = CallBackResultArray::transform($callbackResult->response);
            $callbackResultHtml = $this->callBackResult($callbackResultArray, $callbackResult->created_at);

            $verifyRequestHtml = view('partial.verifyRequest')->with(['order_uuid' => $order->uuid])->render();

            if (!empty($verifyResult)) {
                $verifyResultArray = VerifyTransformer::transform($verifyResult);
                $verifyResultHtml = $this->verifyResult($verifyResultArray['view']['response'], $verifyResultArray['view']['request'], $verifyResult->http_code, $verifyResultArray['view']['step_time'], $verifyResultArray['view']['request_time']);
            }
        }

        return view('show')->with([
            'order' => $order,
            'paymentAnswerHtml' => $paymentAnswerHtml,
            'transferToPortHtml' => $transferToPortHtml,
            'callbackHtml' => $callbackHtml,
            'callbackResultHtml' => $callbackResultHtml,
            'verifyRequestHtml' => $verifyRequestHtml,
            'verifyResultHtml' => $verifyResultHtml,
        ]);
    }

}
