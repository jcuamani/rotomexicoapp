<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLinkedBC extends Model
{
    use HasFactory;
     protected $table = 'customer_linked_bc';
     protected $fillable = ['customer_id','No'];

    public function parentCustomers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
    

}
