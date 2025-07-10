<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUserActivity;

class Customer extends Model
{

        use HasFactory, TracksUserActivity;
     protected $table = 'customer';
     protected $fillable = ['name'
        ,'email'
        ,'email_verified_at'
        ,'password'
        ,'idshopaccounttype'
        ,'account_role'
        ,'ono_to_one_account_relation'
        ,'linked_customers'
        ,'can_order_products'
        ,'can_see_prices'
        ,'can_see_stock'
        ,'estatus'];

        public function linkedCustomers()
        {
        return $this->hasMany(CustomerLinkedBC::class, 'customer_id');
        }
}
