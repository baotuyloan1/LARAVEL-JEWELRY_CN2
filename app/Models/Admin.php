<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps= false;
    protected $fillable= [
        'admin_name','admin_password','admin_email','admin_phone','admin_token','created_at','updated_at'
    ];
    protected $primaryKey ='admin_id';
    protected $table = 'tbl_admin';
}
