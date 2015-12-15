@extends('layout')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Reuniones <small></small>
        </h1>
        <ol class="breadcrumb" style="overflow: hidden">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>

            <li class="pull-right">
                 <button id="btnNewReuniones" class="btn btn-warning">
                 Crear Nuevo
                 <i class="fa fa-users fa-4x" style="margin-left: 20px;vertical-align: middle"></i>
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
          <div class="form-group" style=" padding-left: 30px">
            <label for="criterioText">Criterio</label>
            <input type="text" class="form-control" id="criterioText" placeholder="Eidelman " value="{{ $criterio }}"
            style="width: 90%">
          </div>
          <div class="form-group" style="padding-left: 30px">
            <label for="txtFechaI">Fecha Inicio</label><br/>
            <input type="date" class="form-control" id="txtFechaI" placeholder="dd/mm/aaaaa" value="{{ $fechaI }}">
          </div>
          <div class="form-group" style="padding-left: 30px">
            <label for="txtFechaF">Fecha Fin</label><br/>
            <input type="date" class="form-control" id="txtFechaF" placeholder="dd/mm/aaaaa" value="{{ $fechaF }}">
           </div>

           <div class="form-group" style="padding-left: 30px">
             <button id="btnBuscar" type="submit"  class="btn btn-success" style="width: 200px;padding-left: 30px">
             Buscar<i class="fa fa-search fa-2x" style="margin-left: 20px;"></i>
             </button>
           </div>


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
                            <th >Id</th>

                            <th width="300px">Descripcion</th>
                            <th >fecha</th>
                            <th >Multa</th>
                          <!--  <th>Apoderado</th>
                            <th>Codigo de Barras</th>-->
                            <th >Opciones</th>
                            <th >Asistencias</th>
                        </tr>
                        @foreach ($reuniones as $reunion)
                        <tr>

                              <td >{{ $reunion->id }}</td>
                              <td >{{ $reunion->descripcion }}</td>

                              <td> {{ $reunion->fechaf }}</td>
                              <td>S/. {{ $reunion->multa }}</td>
                              <td>
                                  <div class="btn-group" role="group" aria-label="...">
                                      <a class="btn btn-info" href="{{ URL::route('edit-reunion', array('id'=>$reunion->id)) }}">
                                        Editar <i class="fa fa-pencil-square-o"></i> </a>
                                     <button class="btn btn-danger"
                                      data-toggle="modal" data-target="#mDeletePersona"
                                      onclick="delReunion('{{ $reunion->id }}','{{ $reunion->descripcion }}')"
                                      >Eliminar <i class="fa fa-times"></i> </button>

                                  </div>
                              </td>
                              <td>
                                  <div class="btn-group" role="group" aria-label="...">
                                    <a class="btn btn-default" href="{{ URL::route('selectAsistencia', array('id'=>$reunion->id)) }}">
                                        Ver <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary" href="{{ URL::route('regAsistencia', array('id'=>$reunion->id)) }}"
                                    @if($reunion->estado =='cierre' or $reunion->fecha != date("Y-m-d"))
                                        disabled
                                    @endif>
                                        Registrar <i class="fa fa-pencil-square-o"></i>

                                    </a>
                                    <button class="btn btn-danger" onclick="cierre('{{ $reunion->id  }}','{{ $reunion->descripcion }}')"
                                      @if($reunion->estado =='cierre' or $reunion->fecha != date("Y-m-d"))
                                        disabled
                                      @endif>
                                      Cerrar <i class="fa fa-angellist"></i>
                                    </button>

                                  </div>
                              </td>
                          </tr>
                         @endforeach
                    </table>

                    {{ $reuniones->links() }}
                    </div>
                </div>

             </div>
    </div>
    </div>
</div>

<!-- Modal para ver cierre de reuniones-->
<div class="modal fade" id="mCierreReunion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header contPersona">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1>Cierre de Reunion</h1>
      </div>
      <div class="modal-body" id="contPersona" style="background-color: #f3f3f4">
        Está seguro de querer cerrar la reunion ?
        <input id="txtCierreReunion" type="text" class="form-control" readonly/><br/>
      {{ Form::open(['route' => 'cierreReunion','method' => 'POST', 'role' => 'form']) }}
      {{ Form::hidden('txtReunionId') }}
       <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
       <button id="btnCerrar" type="submit" class="btn btn-primary">SI</button>
       {{ Form::close() }}

      </div>
      <div class="modal-footer bg-danger">
        <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-info-circle"></i>  <strong>* Recuerde que al cerrar la reunion , se registrar todas las multas</strong>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- Modal para eliminar -->
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

        {{ Form::open(['route' => 'delReunion','method' => 'POST', 'role' => 'form']) }}
        {{ Form::hidden('txtId') }}
        <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
        <button id="btnEliminar" type="submit" class="btn btn-primary">SI</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>




<script>

//es para pasar datos al modal
 function delReunion(id,nombre){

    $("#txtValor").val(nombre);
    $("#btnEliminar").val(id);
    $("#txtId").val(id);

    $('input[name^=txtId]').val(id);

}


function validar(){

    var txtFechaI  = $('#txtFechaI').val();
    var txtFechaF  = $('#txtFechaF').val();
    var mensaje = '';
    if((Date.parse(txtFechaI)) >  (Date.parse(txtFechaF))){
       mensaje = 'La fecha inicial no puede se mayor que la final';
    }

    return mensaje;

}

//para el cierre
function cierre(id,descripcion){
    $("#txtCierreReunion").val(descripcion);
    $("#btnCerrar").val(id);
     $('input[name^=txtReunionId]').val(id);
    $('#mCierreReunion').modal('show')
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
            var txtFechaI  = $('#txtFechaI').val();
            var txtFechaF  = $('#txtFechaF').val();

            if(txtCriterio.length<1){
                txtCriterio='*';
            }

            var mensaje = validar();

            if(mensaje.length==0){

                if(txtFechaI=='' || txtFechaF==''){
                    location.href="{{ URL::route('reuniones') }}/"+txtCriterio+"/n<>n";
                }else
                    location.href="{{ URL::route('reuniones') }}/"+txtCriterio+"/"+txtFechaI+"<>"+txtFechaF;
            }else
                alert(mensaje);

            //location.href="";

        });


        $("#btnNewReuniones").click(function(e) {
            e.preventDefault();
            location.href="{{ URL::route('new-reunion') }}";

        });
        $("#btnRefresh").click(function(e) {
            e.preventDefault();
            location.href="{{ URL::route('reuniones') }}/*/n<>n";

        });

        $("#btnCerr").click(function(e) {
            e.preventDefault();
            alert(this.value);

        });




        //esta es para la opcion del modal para ver a un usuario
        $(".btnVer").click(function(e) {
           // e.preventDefault();
           // alert("hola "+$(this).val());
           $.ajax({
           url: '' ,
           type:  'get'
            }).
           done(function(data){
            $("#contPersona").html(data);
            });

        });





	});
</script>




@stop