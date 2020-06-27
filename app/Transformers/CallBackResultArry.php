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
            'id'=>$item->id,
            'date'=>$item->date,
            'amount'=>$item->amount,
            'status'=>$item->status,
            'card_no'=>$item->card_no,
            'order_id'=>$item->order_id,
            'track_id'=>$item->track_id,
            'hashed_card_no'=>$item->hashed_card_no,
        ];
    }
}
