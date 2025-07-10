<?php

namespace App\Traits;

trait TracksUserActivity
{
    public static function bootTracksUserActivity()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->user_create = auth()->user()->name;
                $model->last_user_update = auth()->user()->name;
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->last_user_update = auth()->user()->name;
            }
        });
    }
}
