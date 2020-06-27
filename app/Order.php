<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Order extends Model
{


    public $timestamps = true;


    public $table = 'orders';


    public $fillable = [
        'API_KEY',
        'sandbox',
        'name',
        'phone_number',
        'email',
        'amount',
        'reseller',
        'status',
        'return_id',
    ];


    public function activities()
    {
        return $this->hasMany('App\Activity', 'order_id', 'id');
    }
}
