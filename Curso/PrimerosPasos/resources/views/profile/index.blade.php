@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class ="col-3 p-5">
            <img class="rounded-circle w-100" src="{{$user->profile->profileImage()}}">
        </div>
        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline"></h1> 
            
            <div class="d-flex pb-3 align-items-center">
                <h4 class="mb-n2">{{$user->username}}</h4>
                <!--Aqui lo que estamos haciendo es que mandamos a llamar a nuestro componente follow el cual toma dos argumentos que seria el argumento de follows que es si se esta siguiendo a la persona o no
                y el id del usuario a que se esta viendo-->
                <follow user-id="{{ $user->id }}" follows="{{ $follows }}"></follow>
            </div>
            <!--AQUI LO QUE estamos haciendo es verificar que si la politica de update es correcta sino pues entonces retornar un null-->
            @can ('update', $user->profile)
            <a href="/p/create">Añadir Post</a>
            @endcan
            </div>
            <!--AQUI LO QUE estamos haciendo es verificar que si la politica de update es correcta sino pues entonces retornar un null-->
            @can ('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit">Editar Perfil</a>
            @endcan
            <div class="d-flex">
            <!--Aqui lo que hemos hecho es agregar las variables que tenemos en nuestro index de profile controller para que estos datos se guarden en la cache
            y evitar hacer request cada segundo-->
                <div class="pr-5"><strong>{{$postCount}}</strong> posts</div>
                <div class="pr-5"><strong>{{$followersCount}}</strong> followers</div>
                <div class="pr-5"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class="font-weight-bold pt-4">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>                                                                                                                                                                                       <!--Aqui al usar el ?? significa que es un or ya que si la url es null entonces mostraria el otro dato-->                   
            <div class="font-weight-bold"><a class="text-danger" href="https://l.instagram.com/?u=http%3A%2F%2Fwww.aeon.com.sv%2F&e=ATP0DZkbYC0U7esCohzMDd_cHcdKQyD1FozD8zWMaeficHEfCiYQJFjyQyQYemeuEUWSOygyvQpjkMxinyFd6g&s=1">{{$user->profile->url ?? 'Nada'}}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image}}" class="w-100">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
