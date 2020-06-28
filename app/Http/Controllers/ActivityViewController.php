<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\OrderRepositoryInterface;
use App\Transformers\ActivitiyView;
use App\Transformers\CallBackResultArry;
use App\Transformers\VerifyTransformer;
use Illuminate\Support\Facades\Session;
use Spatie\Fractal\Fractal;
use Hekmatinasser\Verta\Verta;


class ActivityViewController extends MainController
{

    /**
     * @return $this
     */
    public function index()
    {
        return view('index')->with(['paymentAnswerHtml' => '',]);
    }


    /**
     * @param $activityCreateArray
     * @param $httpCode
     * @return array|string
     * @throws \Throwable
     */
    public function paymentAnswer($activityCreateArray, $httpCode)
    {
        return view('partial.paymentAnswer')->with([
            'activity' => $activityCreateArray['data']['view'],
            'http_code' => $httpCode,
        ])->render();

    }


    /**
     * @param $link
     * @param $id
     * @return array|string
     * @throws \Throwable
     */
    public function transferToGetway($link, $id)
    {
        return view('partial.transferToPort')->with([
            'link' => $link,
            'order_id' => $id,
        ])->render();

    }

    /**
     * @param $link
     * @param $stepTime
     * @return array|string
     * @throws \Throwable
     */
    public function callBack($link, $stepTime)
    {

        return view('partial.callback')->with([
            'url' => $link,
            'step_date' => new Verta($stepTime),
        ])->render();
    }


    /**
     * @param $callbackResult
     * @param $stepTime
     * @return array|string
     * @throws \Throwable
     */
    public function callBackResult($callbackResult, $stepTime)
    {

        return view('partial.callbackResult')->with([
            'callbackResult' => $callbackResult,
            'step_tome' => $stepTime,
            'url' => route('callback'),
        ])->render();
    }


    /**
     * @param $response
     * @param $request
     * @param $httpCode
     * @param $stepTime
     * @return array|string
     * @throws \Throwable
     */
    public function verifyResult($response, $request, $httpCode, $stepTime)
    {

        return view('partial.verifyResult')->with([
            'response' => $response,
            'request' => $request,
            'http_code' => $httpCode,
            'step_time' => $stepTime,
        ])->render();

    }

    /**
     * @param Order $order
     * @return $this|void
     * @throws \Throwable
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

        if ($activityCreate == null or $redirectResult == null)
            return abort(404);


        $activityCreateArray = Fractal::create()->item($activityCreate, new ActivitiyView())
            ->toArray();

        $paymentAnswerHtml = $this->paymentAnswer($activityCreateArray, $activityCreate->http_code);

        $transferToPortHtml = $this->transferToGetway(json_decode($activityCreateArray['data']['view']['response'])->link, $order->id);

        $callbackHtml = $this->callBack(json_decode($activityCreateArray['data']['view']['response'])->link, $redirectResult->created_at);

        if ($callbackResult !== null) {
            $status = json_decode($order->activities->where('step', 'return')->last()->response)->status;
            if ((int)$status !== 10) {
                $this->get_status_description($status);
                Session::flash('status', $this->msg . "(" . "وضعیت:" . "$status)");
            }

            $callbackResultArray = Fractal::create()->item($callbackResult->response, new CallBackResultArry())
                ->toArray();


            $callbackResultHtml = $this->callBackResult($callbackResultArray['data'], $callbackResult->created_at->format('Y-m-d h-m-s'));

            $verifyRequestHtml = view('partial.verifyRequest')->with(['order_id' => $order->id,])->render();



            if ($verifyResult !== null) {
                $verifyResultArray = Fractal::create()->item($verifyResult, new VerifyTransformer())->toArray();
                $verifyResultHtml = $this->verifyResult($verifyResultArray['data']['view']['response'], $verifyResultArray['data']['view']['request'], $verifyResult->http_code, $verifyResultArray['data']['view']['step_time']);
            }
        }

        //TODO (WHAY THIS CODE IS ...)

        return view('show')->with(
            [
                'order' => $order,
                'paymentAnswerHtml' => $paymentAnswerHtml,
                'transferToPortHtml' => $transferToPortHtml,
                'callbackHtml' => $callbackHtml,
                'callbackResultHtml' => $callbackResultHtml,
                'verifyRequestHtml' => $verifyRequestHtml,
                'verifyResultHtml' => $verifyResultHtml,
            ]
        );
    }


}
