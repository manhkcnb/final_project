<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{	public $timestamps = false;
    protected $table = 'admins';
    protected $fillable = ['email', 'password', 'recovery_code'];
}


 ?>