@extends('layout')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Usuario <small></small>
        </h1>
        <ol class="breadcrumb" style="overflow: hidden">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>

            <li class="pull-right">
                 <a href="{{ URL::route('sign_up')}}" class="btn btn-warning">
                 Crear Nuevo
                 <i class="fa fa-user-plus fa-4x" style="margin-left: 20px;vertical-align: middle"></i>
                 </a>
                <a href="{{ URL::route('frmUsuarios')}}" class="btn btn-default">
                <i class="fa fa-refresh fa-4x"></i>
                </a>

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
    {{ Form::open(['route' => 'getUsuarios','method' => 'POST', 'role' => 'form','class'=>'form-inline']) }}
        <div class="form-group">
            {{ Form::label('criterio','criterio') }}
            {{ Form::text('criterio', null, ['class' => 'form-control']) }}
        </div>
        <button id="btnBuscar" type="submit" class="btn btn-success">Buscar <i class="fa fa-search"></i></button>
    {{ Form::close() }}
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

                @if(isset($personas))
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                    <table class="table table-hover " style="table-layout:auto">
                        <tr style="background-color:#2e6da4;color: #ffffff">

                            <th >ID</th>
                            <th >Usuario</th>

                            <th >Email</th>
                            <th colspan="2"> Opciones</th>

                        </tr>
                        @foreach ($personas as $persona)
                        <tr>

                              <td >{{ $persona->id }}</td>
                              <td >{{ $persona->usuario }}</td>

                              <td> {{ $persona->email }}</td>


                              </td>

                              <td>
                                <a class="btn btn-info" href="{{URL::route('editUsuario',array('id'=>$persona->id))}}">
                                Editar <i class="fa fa-pencil-square-o"></i> </a>
                              </td>
                               @if($persona->user_type == 'usuario')
                              <td>


                                <button class="btn btn-danger" id="btnDelete" onclick="deleteUser('{{ $persona->usuario }}','{{$persona->id}}')"
                                >
                                Eliminar <i class="fa fa-times"></i> </button>
                              </td>
                              @endif

                          </tr>
                         @endforeach
                    </table>

                    {{ $personas->links() }}
                    </div>
                </div>
                @endif


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
        Está seguro de querer eliminar a este usuario ?
        <input id="txtValor" type="text" class="form-control" readonly/>
      </div>
      <div class="modal-footer">

        {{ Form::open(['route' => 'deleteUsuario','method' => 'POST', 'role' => 'form']) }}
        {{ Form::hidden('txtId') }}
        <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
        <button id="btnEliminar" type="submit" class="btn btn-primary">SI</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>











<script>



function deleteUser(usuario,id){




    $('#mDeletePersona').modal('show');
    $('#txtValor').val(usuario);
    $('input[name^=txtId]').val(id);



}



</script>


@stop