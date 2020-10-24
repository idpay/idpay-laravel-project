<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $fillable = [
        'step',
        'request',
        'response',
        'http_code',
        'request_time',
    ];

}
