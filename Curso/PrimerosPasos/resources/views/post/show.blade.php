@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{$post->image}}" class="w-100">
        </div>
        <div class="col-4">
            <div class="">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="{{$post->user->profile->profileImage()}}" alt="" class="w-100 rounded-circle" style="max-width:40px">
                        </div>
                        <div>
                           <div class="font-weight-bold">
                                <a href="/profile/{{$post->user_id}}">
                                <span class="text-dark">{{$post->user->username}}
                                </span>
                                </a>
                                <a class="pl-2" href="#">Seguir</a>
                           </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p><span class="font-weight-bold text-dark"><a href="/profile/{{$post->user_id}}"><span class="text-dark">{{$post->user->username}}</span></a></span> {{$post->caption}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
