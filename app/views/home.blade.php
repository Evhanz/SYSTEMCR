@extends('layout')

@section('content')

<section class="sectHeader1">

</section>
<span class="modHeader">


</span>


<div class="secContHeader">
   <span>
   
   <img src="{{ asset('imagenes/adds/bg.png') }}" alt=""/>


   </span>
</div>

<div class="sectHeader">
  <span class="titulo">... </span>
</div>


<div class="row" >
    <div class="col-lg-10">
        <h1 style="font-size: 30px"> <strong>SysCR</strong> </h1>
        <p style="font-size: 23px">Bienvenidos al sistema de gestión de asistencias</p>
    </div>
    <div class="col-lg-2">
    <i class="fa fa-street-view fa-5x"></i>
    </div>
</div>


<hr/>
<div  style="background-color: #C5463C;padding: 5px;color: #ffffff">
Modulos
</div>

<div class="row">
    <div class="col-lg-8">
    <div class="panel panel-default">
          <div class="panel-heading">Reuniones entrantes</div>
          <div class="panel-body">
            <table class="table table-bordered">
              <thead>
                <th>ID</th>
                <th>Descripción</th>
                <th>Multas</th>
                <th>Opcion</th>
              </thead>

              <tbody>
              @if(isset($reuniones))

                @foreach($reuniones as $reunion)
                 <tr>
                    <td>{{$reunion->id }}</td>
                    <td> {{$reunion->descripcion}}</td>
                    <td> {{$reunion->multa}}</td>
                    <td><a href="{{ URL::route('regAsistencia', array('id'=>$reunion->id)) }}">Registrar</a></td>
                </tr>
                @endforeach

              @endif
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <div class="col-lg-4">
        <i class="fa fa-clock-o fa-5x"></i>
    </div>
</div>


<section id="sectCont1">

<article>

<hr/>

<footer>
Sistema Creado por @.Evhanz, Treedex.
</footer>


</article>
</section>






@stop
