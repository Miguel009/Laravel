<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function profileImage(){

        $ruta = ($this->image) ? $this->image : 'profile/v8n2tYUgJOKUSoZV2NU1W3lgSfjVdriYIx8nKpxN.jpg';
        return '/storage/'.$ruta;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    /*AQUI ES DONDE ESTA NUESTRA RELACION DE MUCHO A MUCHOS EN LA QUE EXISTE NUESTRA TABLA PIVOTE */
    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
