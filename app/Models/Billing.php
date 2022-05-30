<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    public $timestamps= false;
    protected $fillable= [
        'customer_id', 'billing_name','billing_phone','billing_address','created_at','updated_at'
    ];
    protected $primaryKey ='billing_id';
    protected $table = 'tbl_billing';
}
