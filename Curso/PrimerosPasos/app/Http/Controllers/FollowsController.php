<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{
    /*aqui lo que hacemos es verificar que estamos logueados para poder seguir a la persona */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*AQUI COLODANDO como parametro el USER user lo que hacemos es evitarnos la necesidad de hacer el request() y luego el user::find */
    public function store(User $user){
        /*Aqui lo que estamos haciendo es que se agarre lo que el al usuario que esta logueado en el sistema se va a buscar sus followings o mejor dicho las personas que esta isugiente
        y usando la funcion toggle que seria ese pivote de true o false por asi decirlo se va a colocar o buscar usando el profile del usuario el cual se esta viendo en esos momentos */
        return auth()->user()->following()->toggle($user->profile);
    }
}
