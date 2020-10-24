<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CallBackResultArry extends TransformerAbstract
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
    public function transform($item)
    {
        $item=json_decode($item);

        return [
            'view'=>[
                'id'=>$item->id,
                'status'=>$item->status,
                'order_id'=>$item->order_id,
                'track_id'=>$item->track_id,
            ],
            'CONTENT_TYPE'=>'Content-Type: '.$item->CONTENT_TYPE,
            'REQUEST_METHOD'=>'REQUEST_METHOD: '.$item->REQUEST_METHOD,

        ];
    }
}
