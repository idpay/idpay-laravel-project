<?php

namespace App\Transformers;

class CallBackResultArray
{
    /**
     * A Fractal transformer.
     *
     * @param $item
     * @return array
     */
    public static function transform($item): array
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
