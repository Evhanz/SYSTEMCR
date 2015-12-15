@extends('layout')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Personas <small> que tienen deuda</small>
        </h1>
        <ol class="breadcrumb" style="overflow: hidden">


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
            <input type="text" class="form-control" id="criterioText" placeholder="Eidelman " value="{{ $criterio }}"
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



<div class="row">
    <div class="col-lg-12">
    <table class="table table-hover">
        <thead>
                <tr>
                    <th>id</th>
                    <th>Nombres y apellidos</th>
                    <th>DNI</th>
                    <th>Telefono</th>
                    <th>Celular</th>

                    <th>Opciones</th>
                </tr>
        </thead>
        <tbody>

        @foreach ($personas as $persona)
         @if($persona->multas->count()>0)
            <tr>
                  <td>{{ $persona->id }}</td>
                  <td>{{ $persona->name }}</td>
                  <td>{{ $persona->dni }}</td>
                  <td>{{ $persona->telefono }}</td>
                  <td>{{ $persona->celular }}</td>

                  <td>
                    <a class="btn btn-success" href="{{ URL::route('viewDeudasByPersonas',array('id'=>$persona->id)) }}">
                    Ver Multas
                    </a>

                  </td>

              </tr>
         @endif

         @endforeach
         </tbody>
    </table>

    {{ $personas->links() }}




    </div>
</div>


<script>

$("#btnBuscar").click(function(e) {
    e.preventDefault();
    var txtCriterio  = $('#criterioText').val();

    if(txtCriterio.length<1){
        txtCriterio='*';
    }

    location.href="{{ URL::route('routePrueba') }}/verDeudas/"+txtCriterio;

});


</script>


@stop