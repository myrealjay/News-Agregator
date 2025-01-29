<?php

namespace App\Models\Traits;
use Illuminate\Support\Str;

trait HasUUid
{
    /**
     * Automatically generate a UUID when creating a model
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
}
