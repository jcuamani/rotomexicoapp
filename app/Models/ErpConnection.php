<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUserActivity;

class ErpConnection extends Model
{
    use HasFactory, TracksUserActivity;

    protected $table = 'erp_connections';

    protected $fillable = [
        'connection_type',
        'scope_url',
        'webservice_url',        
        'access_token_url',
        'clientid',
        'client_secret',
        'extra_parameters',
        'connection_timeout',
        'estatus',
        'user_create',
        'last_user_update',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'extra_parameters' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = false; // Ya los manejamos manualmente
}
