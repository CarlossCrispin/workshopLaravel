@extends('layout')
@section('title', "Nuevo usuario")
@section('content')
<h1>Crear Nuevo Usuario</h1>
<div class="col-6 mx-auto">
    @if($errors->any())
    <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
        <strong>Hay errores!</strong>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
</div>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <form method="POST" action="{{url('usuarios/crear')}}">

            {!! csrf_field() !!}


            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control" id="name" aria-describedby="nombre" placeholder="nombre" name="name" value="{{ old('name') }}">
                    @if($errors->has('name'))
                    <div class="alert alert-danger m-0" role="alert">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4"">
                    <input type=" email" class="form-control" id="name" aria-describedby="email" placeholder="correo electrónico" name="email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                    <div class="alert alert-danger m-0" role="alert">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4"">
                    <input type=" password" class="form-control" id="password" aria-describedby="password" placeholder="contraseña" name="password">
                    @if($errors->has('password'))
                    <div class="alert alert-danger m-0" role="alert">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                </div>

            </div>


            <button type="submit" class="btn btn-primary m-3 float-right">Envíar</button>
        </form>
    </div>
</div>
<a href="{{url()->previous()}}" class="btn btn-block btn-outline-info mt-5">regresar</a>
@endsection