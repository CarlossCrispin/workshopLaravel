@extends('layout')
@section('title')
@section('content')
<div class="container-fluid mx-auto">

    <h1 class="display-4 ">Página no encontrada</h1>

    <img src="https://www.lancetalent.com/blog/wp-content/uploads/error-404-github.gif" alt="fondo" class="img-fluid">
    <a href="{{url('/usuarios/')}}" class="btn btn-block btn-outline-info mt-5">regresar</a>
</div>

@endsection