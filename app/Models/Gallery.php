<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps= false;
    protected $fillable= [
        'product_name','images_detail','id_product','created_at','updated_at'
    ];
    protected $primaryKey ='id';
    protected $table = 'tbl_imagesdetail';
}
