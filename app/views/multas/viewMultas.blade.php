@extends('layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Multas <small></small>
        </h1>
        <ol class="breadcrumb" style="overflow: hidden">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
            <li class="active">
                Apoderado :{{$persona->name}}
            </li>
        </ol>
    </div>
</div>

<!--Esto es para el modulo de avisos-->
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



<div class="row-fluid">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Costo</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>

    <tbody>

    @foreach($persona->multas as $multa)

        <tr>
            <td>{{ $multa->reunion->descripcion }}</td>
            <td>{{ $multa->multa }}</td>
            <td>{{ $multa->estado }}</td>
            <td>
            @if($multa->estado == 'deuda')
                <button onclick="pagarDeuda('{{ $multa->id }}','{{ $multa->multa }}')"
                id="btnPagar" class="btn btn-success"  >Pagar</button>
            @else
                <button onclick="editarDeuda('{{ $multa->id }}','{{ $multa->multa }}','{{ $multa->n_comprobante }}')"
                id="btnEditar" class="btn btn-warning"  >Editar</button>
            @endif
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>


</div>

<!-- Modal para pago de multa  de reuniones-->
<div class="modal fade" id="mPagoMulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header contPersona">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1>Pago de multa</h1>
      </div>
      <div class="modal-body" id="contPersona" style="background-color: #f3f3f4">
        Formulario de Pago :
      {{ Form::open(['route' => 'payDeuda','method' => 'POST', 'role' => 'form']) }}
      {{ Form::hidden('txtMultaId') }}

      {{ Form::label('monto','monto') }}
      {{ Form::text('monto', null, ['class' => 'form-control','readonly'=>'readonly']) }}
      {{ Form::label('nComprobante','N° de Comprobante') }}
      {{ Form::text('nComprobante', null, ['class' => 'form-control','required'=>'required']) }}
        <br/>
        <button id="btnCerrar" type="submit" class="btn btn-primary">Guardar</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

       {{ Form::close() }}

      </div>
      <div class="modal-footer">


      </div>
    </div>
  </div>
</div>



<script>


function pagarDeuda(id,multa){
    $('#monto').val(multa);
    $('input[name^=txtMultaId]').val(id);
    $('#mPagoMulta').modal('show');

}

function editarDeuda(id,multa,nComprobante){
    $('#monto').val(multa);
    $('input[name^=txtMultaId]').val(id);
     $('#nComprobante').val(nComprobante);
    $('#mPagoMulta').modal('show');

}






</script>


@stop