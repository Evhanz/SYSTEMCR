@extends('layout')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Deudas <small> - por seccion y grado</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<hr>

  @if(isset($fail))
     <div class="row-fluid">
         <div class="alert alert-danger alert-dismissable">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="fa fa-info-circle"></i>  <strong>{{$fail}}</strong>
          </div>
     </div>
  @endif
<!-- /.row -->
<!-- esto es para magia -->
<div>
<input id="hNivel" type="hidden" value="{{{ $data['nivel'] or '' }}}"/>
<input id="hGrado" type="hidden"  value="{{{ $data['grado'] or '' }}}"/>
<input id="hSeccion" type="hidden"  value="{{{ $data['seccion'] or '' }}}"/>


</div>


    {{ Form::open(['route' => 'getDeudasByGradoAndSeccion','method' => 'POST', 'role' => 'form','class'=>'form-inline']) }}
        <div class="form-group">
            {{ Form::label('nivel','Nivel') }}
            {{ Form::select('nivel', array(null=>'Ninguno','Primaria' => 'Primaria', 'Secundaria' => 'Secundaria'),'Ninguno',['class' => 'form-control','required'=>'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('grado','Grado') }}
            {{ Form::select('grado', array(null=>'Ninguno','1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6'),'Ninguno',['class' => 'form-control','required'=>'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('seccion','Seccion') }}
            {{ Form::select('seccion', array(null=>'Ninguno','A' => 'A', 'b' => 'B','C' => 'C'),'Ninguno',['class' => 'form-control','required'=>'required']) }}

        </div>
        <button id="btnEliminar" type="submit" class="btn btn-success">Buscar <i class="fa fa-search"></i></button>
        <a id="btnImprimir" class="btn btn-default">Imprimir <i class="fa fa-print "></i></a>
    {{ Form::close() }}

    <hr>

    <br/>
    @if(isset($array))
       <div class="panel-group" id="accordion">

       @foreach( $array as $persona)
        <div class="panel panel-info">
           <div class="panel-heading">
             <h2 class="panel-title">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$persona->id}}">
                <i class="fa fa-thumb-tack "></i>
               {{$persona->name}}</a>
             </h2>
           </div>
           <div id="collapse{{$persona->id}}" class="panel-collapse collapse in">
             <div class="panel-body">
                 <h4>El apoderado falto a las siguientes reuniones:</h4>
                 <hr>
                 <h3> {{$persona->apoderado}} </h3>
                 <ul class="list-group">
                 @foreach($persona->multas as $multa)
                    <li class="list-group-item">{{$multa->reunion->descripcion}}</li>
                 @endforeach
                 </ul>

             </div>
           </div>
         </div>

       @endforeach




       </div>

    @endif

<hr>

<style>
    .form-group > label{
        margin-right: 20px;
    }
    .form-group > select{
            margin-right: 10px;
        }

</style>

<script>
    $(document).ready(function(){
        var nivel = $('#hNivel').val();
        var grado = $('#hGrado').val();
        var seccion = $('#hSeccion').val();

        if(nivel.length>0||grado.length>0||seccion.length>0){
            $('#nivel').val(nivel);
            $('#grado').val(grado);
            $('#seccion').val(seccion);
        }


        $("#btnImprimir").click(function(e) {

            e.preventDefault();

           var url ='{{ URL::route('frmReporte') }}/'+nivel+"-"+grado+"-"+seccion;

           var n =window.open(url);
           n.print();


        });



    });
</script>


@stop