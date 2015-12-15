@extends('layout')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Reunion <small> - {{ $reunion->descripcion  }}</small>
        </h1>
        <ol class="breadcrumb" style="overflow: hidden">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>

        </ol>
        <span style="float: right">
            <button class="btn btn-default">Imprimir <i class="fa fa-print"></i></button>
            
        </span>
    </div>
</div>

 @if(Session::has('confirm'))
    <div class="row-fluid">
        <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong>
         </div>
    </div>
 @endif

  @if(Session::has('fail'))
     <div class="row-fluid">
         <div class="alert alert-danger alert-dismissable">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="fa fa-info-circle"></i>  <strong>{{ Session::get('fail') }}</strong>
          </div>
     </div>
  @endif



<!--aca empieza la tabla de todas las personas -->
<div class="row">
    <div class="col-lg-12 table-responsive">

    <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Personas</h3>
            </div>
            <div class="panel-body" id="gridPersona">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                    <table class="table table-hover " style="table-layout:auto">
                        <tr style="background-color:#2e6da4;color: #ffffff">
                            <th>ID</th>
                            <th width="300px">Nombres y apellidos</th>
                            <th >DNI</th>
                            <th >Celular</th>
                            <th >hora</th>
                          <!--  <th>Apoderado</th>
                            <th>Codigo de Barras</th>-->
                            <th colspan="3">Estado</th>
                        </tr>
                        @foreach ($personas as $persona)
                        <tr>
                              <td>{{$persona->id}}</td>
                              <td >{{$persona->name}}</td>
                              <td >{{ $persona->dni }}</td>
                              <td >{{ $persona->celular }}</td>
                              <td>{{ $persona->pivot->hora }}</td>
                              <td>
                                @if($persona->pivot->estado == true)
                                asistio
                                @else
                                no asistio
                                @endif
                              </td>
                              <td>

                              </td>
                              <td>

                              </td>
                          </tr>
                         @endforeach
                    </table>

                    </div>
                </div>

             </div>
    </div>
    </div>
</div>
@stop