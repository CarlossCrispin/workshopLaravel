@extends('layout')
@section('title', "Usuario {$user->id}")
@section('content')
<div class="container">

    <div class="col-sm-12 col-md-6 mx-auto p-5">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h1 class="display-4">Usuario # {{$user->id}}</h1>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="material-icons mr-5 ">face</i>{{$user->name}}</li>
                <li class="list-group-item"><i class="material-icons mr-5 ">mail</i>{{$user->email}}</li>

            </ul>
            <div class="col-12">
                <div class="row float-right">
                    <form method="POST" action="{{url("usuarios/{$user->id}")}}">
                        {{ method_field('DELETE')}}
                        {!! csrf_field() !!}
    
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de eliminar a : {{$user->name}}?')">Borrar</button>
                    </form>
                    <br>
                    <a type="button float-right" class="btn btn-outline-warning" href="{{url('/usuarios/'.$user->id)}}/edit">editar</a>
                </div>

            </div>
        </div>
        <a href="{{url()->previous()}}" class="btn btn-block btn-outline-info mt-5">regresar</a>
    </div>
</div>
<!-- <h1>Usuario #{{$user->id}}</h1>
<h3>Mostrando detalles del usuario  {{$user->name}}</h3>
<h4>Email: {{$user->email}}</h4> -->
@endsection