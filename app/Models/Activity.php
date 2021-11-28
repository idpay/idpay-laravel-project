<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    public $fillable = [
        'step',
        'request',
        'response',
        'http_code',
        'request_time',
    ];

    /**
     * @return string
     */
    public function getMaskApiKeyAttribute(): string
    {
        return Str::mask($this->request->API_KEY, '*', 3, 30);
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function getRequestAttribute($value)
    {
        return json_decode($value);
    }
}
