<?php

namespace App\Transformers;

use Carbon\Carbon;

class VerifyTransformer
{
    /**
     * A Fractal transformer.
     *
     * @param $activity
     * @return array
     */
    public static function transform($activity)
    {
        $params = json_decode($activity['request']);

        $header = [
            'Content-Type' => 'application/json',
            "X-API-KEY" => $params->API_KEY,
            'X-SANDBOX' => (int)$params->sandbox
        ];

        if (isset($activity['created_at'])) {
            $created_at = $activity['created_at'];
        } else {
            $created_at = now()->format('Y-m-d H:i:s');
        }

        return [
            'view' => [
                'request' => json_encode([
                    'url' => 'Post: ' . env('IDPAY_ENDPOINT', 'https://api.idpay.ir/v1.1') . '/payment/verify',
                    'header' => $header,
                    'params' => self::params($params)
                ]),
                'response' => $activity['response'],
                'step_time' => jdate('Y-m-d H:i:s', Carbon::parse($created_at)->timestamp),
                'request_time' => $activity['request_time'],
            ],
        ];
    }

    /**
     * @param $params
     * @return array
     */
    protected static function params($params)
    {
        return [
            'id' => $params->id,
            'order_id' => $params->order_id,
        ];
    }
}
