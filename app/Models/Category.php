<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\{Product, LogActivity};
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'description'];
    
    protected $guarded = [], $keyType = 'string';

    public $incrementing = false;

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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
