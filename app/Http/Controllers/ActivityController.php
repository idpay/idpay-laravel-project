<?php

namespace App\Http\Controllers;

use App\Activity;
use App\order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ActivityController extends Controller
{
    /*
     * show all step payment
     */
    public function show($id = 0)
    {
        $activity = [];
        $order = [];
        $data = [];
        if ($id != 0) {
            $order=Order::where('id',$id)->first();
            $activity = Activity::where('order_id', $id)->get();
            $activity->toJson();

        }
        $data['activity'] = $activity;
        $data['order'] = $order;

        return view('show', $data);
    }

    /*
     * get input data and insert in database and connect to idpay and create transaction
     */
    public function store(Request $request)
    {
        //set params for insert in db and connect to payment api IDPay
        $params = [
            'API_KEY' => $request->values['APIKEY'],
            'sandbox' => $request->values['sandbox'],
            'name' => $request->values['name'],
            'phone' => $request->values['phone'],
            'mail' => $request->values['mail'],
            'amount' => $request->values['amount'],
            'reseller' => $request->values['reseller'],
            'status' => 'processing'
        ];

        $params['order_id'] = order::insertGetId($params);
        $params['desc'] = 'توضیحات پرداخت کننده';
        $params['callback'] = 'http://127.0.0.1:8000/callback';

        //set value for request field order table
        $_request['url'] = 'POST: https://api.idpay.ir/v1.1/payment';
        $_request['header'] = [
            'Content-Type' => 'application/json',
            "X-API-KEY" => $params['API_KEY'],
            'X-SANDBOX' => $params['sandbox']
        ];

        $_request['params'] = $params;

        //connect to Payment API IDPay
        $client = new Client();
        $res = $client->request('POST', 'https://api.idpay.ir/v1.1/payment',
            [
                'json' => $params,
                'headers' => $_request['header'],
                'http_errors' => false
            ]);
        $response = json_decode($res->getBody());


        if ($res->getStatusCode() == 201) {

            //insert return id from API in order table
            Order::where('id', $params['order_id'])
                ->update(['return_id' => $response->id]);
        }

        //set value for activity table
        $activity = [
            'order_id' => $params['order_id'],
            'step' => 'create',
            'request' => json_encode($_request),
            'response' => $res->getBody()
        ];
       $id=Activity::insertGetId($activity);



       $data=Activity::where('id',$id)->first();
       $data->tojson();
       $data->request=json_decode($data->request);
       $data->response=json_decode($data->response);
        return $data;

    }

    /*
     * after connect in API IDPay return this function
     */
    public function callback(Request $request)
    {


        //check pay amount is equal orginal amount
        $order = Order::where('id', $request->order_id)->first();
        if ($order->amount != $request->amount) {
            $request->request->add(['status' => 405]);
        }


        $request->request->add(['message' => $this->get_status_description($request->status)]);

        //set data for insert in activity table
        $activity = array(
            'order_id' => $request['order_id'],
            'step' => 'return',
            'request' => json_encode([]),
            'response' => json_encode($request->all())
        );
        Activity::insert($activity);


        return redirect()->route('show', $request['order_id']);

    }

    /*
     * set message
     */
    public function get_status_description($status)
    {
        switch ($status) {
            case 1:
                return 'پرداخت انجام نشده است';
                break;
            case 2:
                return 'پرداخت ناموفق بوده است';
                break;
            case 3:
                return 'خطا رخ داده است';
                break;
            case 4:
                return 'بلوکه شده';
                break;
            case 5:
                return 'برگشت به پرداخت کننده';
                break;
            case 6:
                return 'برگشت خورده سیستمی';
                break;
            case 7:
                return 'انصراف از پرداخت';
                break;
            case 8:
                return 'به درگاه پرداخت منتقل شد';
                break;
            case 10:
                return 'در انتظار تایید پرداخت';
                break;
            case 100:
                return 'پرداخت تایید شده است';
                break;
            case 101:
                return 'پرداخت قبلا تایید شده است';
                break;

            case 200:
                return 'به دریافت کننده واریز شد';
                break;
            case 405:
                return 'تایید پرداخت امکان پذیر نیست.';
                break;

        }

    }

    /*
     * connect to verify API IDPay and check double spendding
     */
    public function verify(Request $request)
    {

        $params = [
            'id' => $request['id'],
            'order_id' => $request['order_id'],
        ];
        $order = order::where('id', $request['order_id'])->first();

        $_request['params'] = $params;
        $_request['url'] = 'POST: https://api.idpay.ir/v1.1/payment/verify';
        $_request['header'] = [
            'Content-Type' => 'application/json',
            "X-API-KEY" => $order['API_KEY'],
            'X-SANDBOX' => $order['sandbox']
        ];

        //connect to verify API IDPay
        $client = new Client();
        $res = $client->request('POST', 'https://api.idpay.ir/v1.1/payment/verify',
            [
                'json' => $params,
                'headers' => $_request['header'],
                'http_errors' => false

            ]);

        $response = json_decode($res->getBody());

        //double sppending
        if ($request['order_id'] != $response->order_id || $request['id'] != $response->id) {
            $response->status = 405;

        }

        //insert in activity table
        $activity = [
            'order_id' => $request['order_id'],
            'step' => 'verify',
            'request' => json_encode($_request),
            'response' => $res->getBody()
        ];
        $id=Activity::insertGetId($activity);

        //update staus
        Order::where('id', $params['order_id'])
            ->update(['status' => 'complete']);


        $data=Activity::where('id',$id)->first();
        $data->tojson();
        $data->request=json_decode($data->request);
        $data->response=json_decode($data->response);
        return $data;

    }

    public function store_callback(Request $request)
    {

        //insert in activity table
        $activity = [
            'order_id' => $request['order_id'],
            'step' => 'redirect',
            'request' => json_encode(['url ' . $request['link']]),
            'response' =>json_encode([])
        ];
        Activity::insert($activity);


    }
}
