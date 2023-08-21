<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    
    protected $fillable = ['name', 'category_id', 'price', 'photo'];
    
   
    protected $hidden = ['password', 'remember_token'];
    
   
    
}

 ?>