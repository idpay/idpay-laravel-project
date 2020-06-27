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


        return [

            'view' => [
                'request' => json_encode([
                    'url' => 'https://api.idpay.ir/v1.1/verify',
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

            "id" => $params->id,
            "order_id" => $params->order_id,

        ];
    }



}
