@extends('lreportes')

@section('content')
<h1>Hola que hace {{$persona->apoderado->nombre }}</h1>

<img src="{{ asset('imagenes/profiles') }}/{{ $persona->foto }}" alt=""/>

@stop