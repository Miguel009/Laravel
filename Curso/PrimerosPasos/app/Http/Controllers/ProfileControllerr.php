<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfileControllerr extends Controller
{
    public function index($user)
    {
        /*con el find or fail lo que hacemos es que en vez de dar un error gigante cuando se busque otro usuario mandar un mensaje en este caso seria un 404 */
       $user = User::findOrFail($user);
        /*Aqui lo estamos enviando a la blade de home solo con poner que es view entonces sabes que hablamos de home.blade.php*/
        /*aunque ahora le cambiamos el nombre y pusimos ese home dentro de una carpeta que ahora se llama profile y dentro de esa carpeta esta el home que ahora se llama index entonces
        para llamar esto se tienen dos formas se puede llamar como un slahs profile/index o con un punto como se pude ver ahi y lo que estamos diciendo es que busque en la carpeta profile el index */
        /*Aqui lo que estamos haciendo es que el calculo de las variables sea cada 30 segundo y mientras pasan pues la info se va a encontrar guardada en la cache
        asi como esta de follows lo que esta haciendo es verificar si el usuario esta conectado y verificar si el usuario que estamos busanco el usuario autentificado lo esta siguiendo o no */
        $follows=(auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember('count.posts'.$user->id, now()->addSeconds(30), function () use ($user){
           return $user->posts->count();
        });
        $followersCount = Cache::remember('count.followers'.$user->id, now()->addSeconds(30), function () use ($user){
            return $user->profile->followers->count();
         });
        $followingCount = Cache::remember('count.following'.$user->id, now()->addSeconds(30), function () use ($user){
            return  $user->following->count();
         });
        return view('profile.index', [
            'user' => $user,
            'follows'=>$follows,
            'postCount'=>$postCount,
            'followersCount'=>$followersCount,
            'followingCount'=>$followingCount
        ]);
    }
    /*AQUI COLODANDO como parametro el USER user lo que hacemos es evitarnos la necesidad de hacer el request() y luego el user::find */
    public function edit(User $user){
        /*aqui estamos usando una de las opciones de laravle que se llaman policies que como se puede ver es una carpeta que esta en http y aqui lo que hacemos es verificar a ver si 
        la persona puede editar en el metodo update que esta en profilepolicy.php donde validamos que el use id tiene que ser el mismo al del user profile */
        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }

    public function update(User $user){
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' =>'required',
            'description' => 'required',
            'url'=>'url',
            'image'=>''
        ]);
        
        if(request('image')){
            $imagen = request('image')->store('profile', 'public');

            /*aqui lo unico que estamos haciendo es realizar un resize de la imagen utilizando una clase de una libreria llamada intervention  */
            $img = Image::make(public_path("storage/{$imagen}"))->fit(1000, 1000);
            $img->save();

            $imagenArreglo = ['image'=>$imagen];
        }

        auth()->user()->profile->update(array_merge($data, $imagenArreglo ??[]));

        return redirect("/profile/".$user->id);
    }
}
