<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = ['name', 'category_id', 'price', 'photo'];
    protected $dates = ['deleted_at'];

   
}
