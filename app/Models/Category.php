<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [], $incrementing = false, $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->keyType) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
