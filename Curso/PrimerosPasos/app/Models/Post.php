<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /*con esto le decimos a laravel que no se preocupe por los datos que estamos pasando ya que en el controll ya estamos manejando que tipo de datos vamos a mandar y no solo el request */
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
