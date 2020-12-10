@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
        <!--Esto agregara un token el cual nos permite usar para autenticar este form para poder usar nuestros endpoint de las apis para que asi los post sean solo en lugares autorizados-->
        @csrf
        @method('PATCH')
        <div class="row">
        <h1>Editar Perfil</h1>
                <div class="col-8 offset-2">
                    <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Titulo</label>

                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Descripcion</label>

                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description }}" autocomplete="description" autofocus>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">URL</label>

                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url}}" autocomplete="url" autofocus>

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Imagen</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                        @error('image')
                                <strong>{{ $message }}</strong>
                        @enderror
                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
