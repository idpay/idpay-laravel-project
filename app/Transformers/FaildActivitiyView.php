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

        $created = new Verta($activity['created_at']);


        return [

            'view' => [
                'request' => json_encode([
                    'url' => 'Post: https://api.idpay.ir/v1.1/payment',
                    'header' => $header,
                    'params' => $this->params($params)
                ]),
                'response' => $activity['response'],
                'step_time' => $created->format('Y-m-d H:i:s'),



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
            "reseller" => $params->reseller,
        ];
    }

}
