@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class ="col-3 p-5">
            <img class="rounded-circle" src="https://instagram.fsal2-1.fna.fbcdn.net/v/t51.2885-19/s150x150/66476284_503746503714541_1460686856604614656_n.jpg?_nc_ht=instagram.fsal2-1.fna.fbcdn.net&_nc_ohc=7IWll7eahpUAX9trqvZ&tp=1&oh=b4c45c17b7284e9b781c7ee4752aa3ad&oe=5FF1F9A5">
        </div>
        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline"><h1>{{$user->username}}</h1> <a href="#">Añadir Post</a></div>
            <div class="d-flex">
                <div class="pr-5"><strong>15</strong> posts</div>
                <div class="pr-5"><strong>1</strong> followers</div>
                <div class="pr-5"><strong>15</strong> following</div>
            </div>
            <div class="font-weight-bold pt-4">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>                                                                                                                                                                                       <!--Aqui al usar el ?? significa que es un or ya que si la url es null entonces mostraria el otro dato-->                   
            <div class="font-weight-bold"><a class="text-danger" href="https://l.instagram.com/?u=http%3A%2F%2Fwww.aeon.com.sv%2F&e=ATP0DZkbYC0U7esCohzMDd_cHcdKQyD1FozD8zWMaeficHEfCiYQJFjyQyQYemeuEUWSOygyvQpjkMxinyFd6g&s=1">{{$user->profile->url ?? 'Nada'}}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4">
            <img src="/storage/{{$post->image}}" class="w-100">
        </div>
        @endforeach
    </div>
</div>
@endsection
