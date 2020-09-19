<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderDetail extends Model
{
    protected $guarded = [], $keyType = 'string';

    use LogsActivity;

    protected static $logAttributes = ['product_id', 'price', 'qty'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relathionship

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
