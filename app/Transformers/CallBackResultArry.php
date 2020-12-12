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
        $item = json_decode($item, true);

        $method = empty($item['CONTENT_TYPE']) ? 'POST' : $item['REQUEST_METHOD'];

        $result = [
            'view'=> $item,
            'CONTENT_TYPE'=>'Content-Type: '.$item['CONTENT_TYPE'],
            'REQUEST_METHOD'=> $method,
        ];

        unset($result['view']['CONTENT_TYPE']);
        unset($result['view']['REQUEST_METHOD']);

        return $result;
    }
}
