<?php

namespace App\Transformers;

use Carbon\Carbon;

class FailedActivityView
{
    /**
     * @param $activity
     * @return array[]
     */
    public static function transform($activity): array
    {
        $params = $activity->request;

        $header = [
            'Content-Type' => 'application/json',
            "X-API-KEY" => $activity->mask_api_key,
            'X-SANDBOX' => (int)$params->sandbox
        ];

        $created = jdate('Y-m-d H:i:s', Carbon::parse($activity['created_at'])->timestamp);

        return [
            'view' => [
                'request' => json_encode([
                    'url' => "Post: ".env('IDPAY_ENDPOINT','https://api.idpay.ir/v1.1')."/payment",
                    'header' => $header,
                    'params' => self::params($params)
                ]),
                'response' => $activity['response'],
                'step_time' => $created,
                'request_time' => $activity['request_time'],
            ],

        ];

    }

    /**
     * @param $params
     * @return array
     */
    protected static function params($params): array
    {
        return [
            "order_id" => $params->order_id,
            "amount" => $params->amount,
            "name" => $params->name,
            "phone" => $params->phone,
            "mail" => $params->mail,
            "desc" => $params->desc,
            "callback" => $params->callback,
            "reseller" => $params->reseller,
        ];
    }
}
