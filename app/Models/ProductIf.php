<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIf extends Model {
    protected $table = 'product_if';
    public $timestamps = false;
    public function products()
    {
        return $this->belongsTo(Products::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}

 ?>