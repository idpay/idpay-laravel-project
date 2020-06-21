<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public $timestamps = true;
    public function get_Activity()
    {
        return $this->hasMany('App\Activity','order_id','id');
    }}
