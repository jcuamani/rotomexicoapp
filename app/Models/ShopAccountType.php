<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUserActivity;

class ShopAccountType extends Model
{
    use HasFactory, TracksUserActivity;
    protected $table = 'c_shopaccounttype';

    protected $fillable = ['clave', 'descr', 'estatus'];
}
