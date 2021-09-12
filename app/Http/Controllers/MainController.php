<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

class MainController extends Controller
{
    /**
     * @var
     */
    public $msg;

    /**
     * @param $api_key
     * @param $sandbox
     * @return array
     */
    public function header($api_key, $sandbox)
    {
        return [
            'Content-Type' => 'application/json',
            "X-API-KEY" => $api_key,
            'X-SANDBOX' => $sandbox
        ];
    }

    /**
     * @param $params
     * @param $header
     * @param $url
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function requestHttp($params, $header, $url)
    {
        $url = Str::startsWith($url, '/') ? $url : "/$url";
        $idpay_endpoint = env('IDPAY_ENDPOINT','https://api.idpay.ir/v1.1').$url;

        $client = new Client();
        $starttime = microtime(1);

        $response = $client->request('POST', $idpay_endpoint,
            [
                'json' => $params,
                'headers' => $header,
                'http_errors' => false
            ]);

        $elapsed = microtime(1) - $starttime;
        $elapsed = number_format((float)$elapsed, 3, '.', '');
        $response->elapsed = $elapsed;

        return $response;
    }

    /**
     * @param $status
     */
    public function get_status_description($status)
    {
        switch ($status) {
            case 1:
                $this->msg = 'پرداخت انجام نشده است.  ';
                break;
            case 2:
                $this->msg = 'پرداخت ناموفق بوده است.';
                break;
            case 3:
                $this->msg = 'خطا رخ داده است.';
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
                $this->msg = 'در انتظار تایید پرداخت.';
                break;
            case 100:
                $this->msg = 'پرداخت تایید شده است.';
                break;
            case 101:
                $this->msg = 'پرداخت قبلا تایید شده است.';
                break;

            case 200:
                $this->msg = 'به دریافت کننده واریز شد.';
                break;
            case 405:
                $this->msg = 'تایید پرداخت امکان پذیر نیست.';
                break;
        }

    }

}
