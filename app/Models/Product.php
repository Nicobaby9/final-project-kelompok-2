<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    protected $guarded = [], $keyType = 'string';

    public $incrementing = false;

    use LogsActivity;

    protected static $logAttributes = ['name', 'description', 'price', 'category_id'];

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
