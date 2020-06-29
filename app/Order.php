<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Order extends Model
{
    public $timestamps = true;

//    protected $primaryKey = "uuid";



    public $table = 'orders';


    public $fillable = [
        'api_key',
        'sandbox',
        'name',
        'phone',
        'email',
        'amount',
        'reseller',
        'status',
        'return_id',
        'callback',
        'desc',
        'uuid',
    ];


    public function getRouteKeyName()
    {
        return 'uuid';
    }


    public function activities()
    {
        return $this->hasMany('App\Activity', 'order_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate(4);
        });
    }

}
