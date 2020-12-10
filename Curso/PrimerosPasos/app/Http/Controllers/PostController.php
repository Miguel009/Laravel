<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        
        return view('post.index', compact('posts'));
    }
    public function create(){
        return view('post.create');
    }

    public function store(){
        /*aqui lo que hacemos es validar la reques para que se coloque en data */
        $data = request()->validate([
            'caption' => 'required',
            'image'=> 'required | image'
        ]);
            /*aqui esto nos permite es guardar nuestro archivo o en este caso imagen dentro de la carpeta storage pero para que esta pueda ser usada en public entonces debemos correr el comando php artisan make:link y ya estaria
            aqui lo que el store nos va a retornar es la direccion adonde fue mandada la imagen y eso es lo que queremos guardar en nuestra base ahora */
        /*los parametros que agarra son el nombre de la carpeta que se va a tener y el nombre de a donde se van a enviar o la credencial a donde se mandaar en este caso sera el server local es decir public*/
       $imagen = request('image')->store('uploads', 'public');

       /*aqui lo unico que estamos haciendo es realizar un resize de la imagen utilizando una clase de una libreria llamada intervention  */
       $img = Image::make(public_path("storage/{$imagen}"))->fit(1200, 1200);
       $img->save();
        /*aqui lo que le estamos diciendo es que auth agarre al user que esta y que por medio de la relacion que tenemos con post cree el post con la data dada y luego laravel va a gregar el id del usuario */
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagen
        ]);
        

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(\App\Models\Post $post){
        /*con esta funcion lo que estamos haciendo es que de un solo laravel puede saber que tipo de dato estamos buscando llamando al modelo de este en la variable o
        parametro ya no tenemos que hacer nada mas porque si no lo encuentra envia de un solo el 404 que significa que no econtro nada */
        return view('post.show', compact('post'));
    }
}
