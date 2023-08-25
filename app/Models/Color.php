<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{	public $timestamps = false;
    protected $fillable = ['name', 'code'];
    public function product_if()
    {
        return $this->hasMany(product_if::class);
    }
}


 ?>