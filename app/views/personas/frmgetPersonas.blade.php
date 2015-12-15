@extends('layout')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Personas <small> - {{ $tipo  }}</small>
        </h1>
        <ol class="breadcrumb" style="overflow: hidden">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>

            <li class="pull-right">
                 <button id="btnNewPersona" class="btn btn-warning">
                 Crear Nuevo
                 <i class="fa fa-user-plus fa-4x" style="margin-left: 20px;vertical-align: middle"></i>
                 </button>
                <button id="btnRefresh" class="btn btn-default">
                <i class="fa fa-refresh fa-4x"></i>
                </button>

            </li>


        </ol>
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
<!-- /.row -->

<!--Aca es para el filtro -->

<div class="row">
    <div class="col-lg-12">
     <form class="form-inline">
          <div class="form-group" style="width: 60%">
            <label for="criterioText">Criterio</label>
            <input type="text" class="form-control" id="criterioText" placeholder="Criterio " value="{{ $criterio }}"
            style="width: 90%">
          </div>

          <button id="btnBuscar" type="submit"  class="btn btn-success" style="width: 200px">
          Buscar<i class="fa fa-search fa-2x" style="margin-left: 20px;"></i>
          </button>
    </form>
    </div>


</div>
<br/>
<!-- /. termina filtro-->


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

                            <th width="300px">Nombres y apellidos</th>
                            <th >Direccion</th>

                            <th >Telefono</th>
                            <th >Celular</th>
                          <!--  <th>Apoderado</th>
                            <th>Codigo de Barras</th>-->
                            <th colspan="4">Opciones</th>
                        </tr>
                        @foreach ($personas as $persona)
                        <tr>

                              <td >{{ $persona->nombre }},
                             {{ $persona->apellidoP }}
                              {{ $persona->apellidoM }}</td>
                              <td >{{ $persona->direccion }}</td>

                              <td> {{ $persona->telefono }}</td>
                              <td>{{ $persona->celular }}</td>
                         <!--     <td>{{{ $persona->apoderado->nombre or 'Apoderado' }}}</td>
                              <td>{{{ $persona->fotocheck->codigo_barras or 'No asignado' }}}</td> -->
                              <td>
                              @if($persona->estado == true)

                                <button  value="{{$persona->id}}" class="btn btn-success btnChange">
                                <i class="fa fa-check-square-o"></i></button>

                              @else
                                <button  value="{{$persona->id}}"  class="btn btn-danger btnChange"><i class="fa fa-ban"></i></button>
                              @endif



                              </td>
                              <td>
                                <div class="btn-group" role="group" aria-label="..">
                                    <button  class="btn btn-default btnVer" value="{{ $persona->id }}"
                                    data-toggle="modal" data-target="#mPersona"> Ver
                                    <i class="fa fa-eye"></i>
                                    </button>
                                    
                                </div>

                              </td>
                              <td>
                                <a class="btn btn-info" href="{{ URL::route('editAlumno', array('tipo'=>$tipo,'id'=>$persona->id)) }}">
                                Editar <i class="fa fa-pencil-square-o"></i> </a>
                              </td>
                              <td>
                                <button class="btn btn-danger" onclick="delPersona('{{ $persona->id }}','{{ $persona->nombre }}','{{ $tipo }}');"
                                 data-toggle="modal" data-target="#mDeletePersona" >Eliminar <i class="fa fa-times"></i> </button>
                              </td>
                          </tr>
                         @endforeach
                    </table>

                    {{ $personas->links() }}
                    </div>
                </div>



             </div>
    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header contPersona">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="contPersona" style="background-color: #f3f3f4">

      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="mDeletePersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h1>Eliminar </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        Está seguro de querer eliminar ?
        <input id="txtValor" type="text" class="form-control" readonly/>
      </div>
      <div class="modal-footer">

        {{ Form::open(['route' => 'delete_alumno','method' => 'POST', 'role' => 'form']) }}
        {{ Form::hidden('txtId') }}
        <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
        <button id="btnEliminar" type="submit" class="btn btn-primary">SI</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>


<!-- Modal para cambiar estado-->

<!-- Modal -->
<div class="modal fade" id="mChangeEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header contPersona">
        <h1>Cambio de estado</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="contPersona" style="background-color: #f3f3f4">
        <p>Se cambiara el estado de la persona, desea continuar ?</p>
      </div>
      <div class="modal-footer">
      {{ Form::open(['route' => 'changeEstado','method' => 'POST', 'role' => 'form']) }}
      {{ Form::hidden('txtIdChange') }}
      {{ Form::hidden('txtTipo') }}
      <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
      <button id="btnChange" type="submit" class="btn btn-primary">SI</button>
      {{ Form::close() }}
      </div>
    </div>
  </div>
</div>




<script>

//es para pasar datos al modal
 function delPersona(id,nombre,Tipo){

    $("#txtValor").val(nombre);
    $("#btnEliminar").val(id);
    $("#txtId").val(id);

    $('input[name^=txtId]').val(id);
    $('input[name^=txtTipo]').val(Tipo);
}


$(document).ready(function(){
$( "#criterioText" ).focus(function() {
          if(this.value=='*'){
           this.value='';
          }
        });


        $("#btnBuscar").click(function(e) {
            e.preventDefault();
            var txtCriterio  = $('#criterioText').val();

            if(txtCriterio.length<1){
                txtCriterio='*';
            }

            location.href="{{ URL::route('personas') }}"+"/"+"{{ $tipo }}"+"/"+txtCriterio;

        });


        $("#btnNewPersona").click(function(e) {
            e.preventDefault();
            location.href="{{ URL::route('frmNewPersona',array('tipo'=>$tipo)) }}";

        });
        $("#btnRefresh").click(function(e) {
            e.preventDefault();
            location.href="{{ URL::route('personas') }}"+"/"+"{{ $tipo }}"+"/*";

        });


        //esta es para la opcion del modal para ver a un usuario
        $(".btnVer").click(function(e) {
           // e.preventDefault();
            //location.href="{{ URL::route('personas') }}"+"/"+"{{ $tipo }}"+"/*";
           // alert("hola "+$(this).val());
           $.ajax({
           url: '{{ URL::route('personas') }}/'+$(this).val() ,
           type:  'get'
            }).
           done(function(data){
            $("#contPersona").html(data);
            });

        });


        /*
        $("#btnEliminar").click(function(e) {
            var id=$("#btnEliminar").val();
            var parametros = {
                    "id" : id
            };
            $.ajax({
                    data:  parametros,
                    url:   '{{ URL::route('delete_alumno') }}',
                    type:  'post',
                    beforeSend: function () {
                            $("#resultado").html("Procesando, espere por favor...");
                    },
                    success:  function (data) {
                       console.log('se elimino los datos'+data);
                    }
            });

        });*/
        $('.btnChange').click(function(){

            $('#mChangeEstado').modal('show');
            $('input[name^=txtIdChange]').val(this.value);


        });

	});
</script>




@stop