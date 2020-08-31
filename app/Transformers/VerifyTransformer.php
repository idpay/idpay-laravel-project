<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Verta;

class VerifyTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($activity)
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
                    'url' => "Post: ".env('IDPAY_ENDPOINT','https://api.idpay.ir/v1.1')."/payment/verify",
                    'header' => $header,
                    'params' => $this->params($params)
                ]),
                'response' => $activity['response'],
                'step_time' => new Verta($created_at),
                'request_time' => $activity['request_time'],
            ],

        ];
    }


    public function params($params)
    {


        return [

            "id" => $params->id,
            "order_id" => $params->order_id,

        ];
    }


}
