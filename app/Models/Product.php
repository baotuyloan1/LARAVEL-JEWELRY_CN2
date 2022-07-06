<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps= false;
    protected $fillable= [
        'product_name','categor_id','discount_id','product_name','product_desc','product_image','product_price','product_status','created_at','updated_at'
    ];
    protected $primaryKey ='product_id';
    protected $table = 'tbl_product';
}
