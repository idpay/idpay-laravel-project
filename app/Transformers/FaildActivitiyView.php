<?php

namespace App\Transformers;

use App\Activity;
use League\Fractal\TransformerAbstract;
use Verta;

class FaildActivitiyView extends TransformerAbstract
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


        return [

            'view' => [
                'request' => json_encode([
                    'url' => 'https://api.idpay.ir/v1.1/payment',
                    'header' => $header,
                    'params' => $this->params($params)
                ]),
                'response' => $activity['response'],
                'step_time' => new Verta($activity['created_at']),



            ],


        ];


    }





    public function params($params)
    {


        return [

            "order_id" => $params->order_id,
            "amount" => $params->amount,
            "name" => $params->name,
            "phone" => $params->phone,
            "mail" => $params->mail,
            "desc" => $params->desc,
            "callback" => $params->callback,
            "status" => $params->status,
            "reseller" => $params->reseller,
        ];
    }

}
