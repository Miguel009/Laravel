@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        <!--Esto agregara un token el cual nos permite usar para autenticar este form para poder usar nuestros endpoint de las apis para que asi los post sean solo en lugares autorizados-->
        @csrf
        <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Titulo</label>

                        <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption" autofocus>

                        @error('caption')
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
                    <button class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
