<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Order extends Model
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    public $table = 'orders';

    /**
     * @var string[]
     */
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

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('App\Activity', 'order_id', 'id');
    }

    /**
     *  Generate uuid
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate(4);
        });
    }

}
