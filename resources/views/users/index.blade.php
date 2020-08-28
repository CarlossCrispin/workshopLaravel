@extends('layout')
@section('title', "Usuarios")
@section('content')

<a class="btn btn-outline-success float-right btn-sm aling-self-center" href="/usuarios/nuevo"><i class="material-icons">add</i>Nuevo </a>
<div class="col-sm-12 col-md-6 mx-auto">
    
    <div class="card">
        <div class="card-header ">
            <h1 class="display-5">{{$title}}</h1>
        </div>

        <ul class="list-group list-group-flush">
            @forelse ($users as $key => $user)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-2 align-self-center">
                        <span class="badge badge-info"># {{$user->id}}</span>
                        <!-- <span class="badge badge-info"># {{$key+1}}</span> -->
                    </div>
                    <div class="col-10">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <i class="material-icons mr-5 ">face</i>
                                </div>
                                <div class="col-10">
                                    <p class="mx-auto display-5"> {{$user->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <i class="material-icons mr-5 ">mail</i>
                                </div>
                                <div class="col-10">
                                    <p class="mx-auto display-5"> {{$user->email}}</p>

                                </div>
                            </div>
                            <div class="btn-group float-right" role="group" aria-label="Basic example">
                                <form method="POST" action="{{url("usuarios/{$user->id}")}}">
                                    {{ method_field('DELETE')}}
                                    {!! csrf_field() !!}

                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de eliminar a : {{$user->name}}?')">Borrar</button>
                                </form>
                                <a type="button" class="btn btn-outline-warning" href="{{url('/usuarios/'.$user->id)}}/edit">editar</a>
                                <a type="button" class="btn btn-outline-info" href="{{url('/usuarios/'.$user->id)}}">detalles</a>
                            </div>
                            <!-- <a class="btn btn-block btn-outline-secondary" href="{{url('/usuarios/'.$user->id)}}">Ver detalles</a> -->

                        </div>
                    </div>
                </div>

            </li>
            @empty
            <li class="list-group-item">
                <div class="alert alert-danger" role="alert">
                    No hay usuarios registrados.
                </div>
            </li>
            @endforelse
        </ul>
        <div class="p-3 mx-auto">
            {{ $users->links("pagination::bootstrap-4") }}
            <p class="text-muted text-center">total de usuarios : {{$users->total()}}</p>
        </div>
    </div>
</div>

@endsection