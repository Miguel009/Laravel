<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileControllerr extends Controller
{
    public function index($user)
    {
        /*con el find or fail lo que hacemos es que en vez de dar un error gigante cuando se busque otro usuario mandar un mensaje en este caso seria un 404 */
       $user = User::findOrFail($user);
        /*Aqui lo estamos enviando a la blade de home solo con poner que es view entonces sabes que hablamos de home.blade.php*/
        /*aunque ahora le cambiamos el nombre y pusimos ese home dentro de una carpeta que ahora se llama profile y dentro de esa carpeta esta el home que ahora se llama index entonces
        para llamar esto se tienen dos formas se puede llamar como un slahs profile/index o con un punto como se pude ver ahi y lo que estamos diciendo es que busque en la carpeta profile el index */
        return view('profile.index', [
            'user' => $user,
        ]);
    }
}
