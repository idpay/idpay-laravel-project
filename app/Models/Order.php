<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Order
 * @package App\Models
 *
 * @property $id
 * @property $activities
 */
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
     * @return HasMany
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'order_id', 'id');
    }

    /**
     *  Generate uuid
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    /**
     * @param $value
     * @return string
     */
    public function getApiKeyAttribute($value): string
    {
        return Str::mask($value, '*', 3, 30);
    }
}
