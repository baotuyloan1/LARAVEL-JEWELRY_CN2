<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps= false;
    protected $fillable= [
        'product_id','customer_id','rating','comments','love','created_at','updated_at'
    ];
    protected $primaryKey ='rating_id';
    protected $table = 'tbl_rating';
}
