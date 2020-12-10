<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    public function profile(){
        return $this->HasOne(Profile::class);
    }
    public function posts(){
        return $this->HasMany(Post::class)->orderBy('created_at', 'DESC');
    }
    /*AQUI ES DONDE ESTA NUESTRA RELACION DE MUCHO A MUCHOS EN LA QUE EXISTE NUESTRA TABLA PIVOTE */
    public function following(){
        return $this->belongsToMany(Profile::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /*Aqui esta es una nueva funcion la cual se ejecuta cuando nosotros digamos o mejor dicho al momento de booteo */
    protected static function boot(){
        parent::boot();
        /*entonces al momento de booteo o que se utilize este modelo lo que hacemos es decirle que cuando se haya creado el usuario le cree un perfil solo con el tittulo del profile
        y ademas mande el email de bienvenida */
        static::created(function ($user){
            $user->profile()->create([
                'title'=>$user->username
            ]);

            Mail::to($user->email)->send(new \App\Mail\NewUserBienvenidaMail());
        });
    }
}
