<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps= false;
    protected $fillable= [
        'billing_id','customer_id','payment_id','order_total','order_status_id','created_at','updated_at'
    ];
    protected $primaryKey ='order_id';
    protected $table = 'tbl_order';
}
