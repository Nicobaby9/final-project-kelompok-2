<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class Cart extends Model
{
    protected $guarded = [], $keyType = 'string';

    use LogsActivity;

    protected static $logAttributes = ['user_id', 'product_id', 'prices', 'jumlah'];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
