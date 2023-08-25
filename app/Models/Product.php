<?php

namespace App\Models;

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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function product_if()
    {
        return $this->hasMany(ProductIf::class);
    }


   
}
