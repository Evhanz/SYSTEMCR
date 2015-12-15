@extends('layout')

@section('content')


<div class="row-fluid">

<h1>Registro de Asistencia de reunion <small>{{ $reunion->descripcion }}</small> </h1>

<h4> Hora de cierre <small>|{{$reunion->hora}}</small> </h4>
<input id="hdIdReunion" type="hidden" value="{{ $reunion->id }}"/>
<hr />
</div>

<div class="row-fluid" id="banner" style="display: none">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-info-circle"></i>  <strong id="mensajeError"></strong>
    </div>
</div>
<div class="row-fluid" id="bannerSuccess" style="display: none">
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-info-circle"></i>  <strong id="mensajeSuccess"></strong>
    </div>
</div>




<div class="row-fluid">
    <form class="form-inline">
      <div class="form-group col-lg-10 col-md-10 ">
          <label for="inputEmail3" class="col-sm-2 control-label">Codigo</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="txtCodigo" placeholder="" style="width: 100%">
          </div>
       </div>
       <div class="col-lg-2 col-md-2 ">
       <!--
       <button id="btnBuscar" type="submit" class="btn btn-info" style="width: 100%" >Buscar</button>-->
       </div>

    </form>
</div>




<div class="row-fluid" >
    <div class="col-lg-12">
        <input type="hidden" id="hdIdPersona" /><br/>
        <input class="form-control" id="txtDescPersona" type="text" style="width: 100%;margin:0px 0px 20px 0px" readonly >
    </div>
</div>


<div class="row-fluid">
    <div class="col-lg-12">
        <button id="btnRegistrar" class="btn btn-primary btn-lg btn-block" style="width: 100%;margin:0px 0px 20px 0px">Registrar</button>
    </div>
</div>



<script>

function buscarDNI(){
$("#banner").fadeOut("slow");
    $("#bannerSuccess").fadeOut("slow");
    var txtCodigo = $('#txtCodigo').val();
    var idReunion = $('#hdIdReunion').val();

     var parametros = {
        "txtCodigo" : txtCodigo,
        "idReunion": idReunion
        };
        $.ajax({
            data:  parametros,
            url:   '{{ URL::route('getApoderado') }}',
            type:  'post',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (data) {
               if (data.indexOf('Error:')!=-1) {
                    $("#banner").fadeOut("slow");
                    $("#banner").fadeIn("slow");
                    $("#mensajeError").html(data);
                    $("#hdIdPersona").val('');
               }else{

                    $("#txtDescPersona").val(data);
                    $("#hdIdPersona").val(txtCodigo);
                    $('#btnRegistrar').attr("disabled", false);

               }
               $('#txtCodigo').val("");
            }
        });
}




//funciones manejadores de evento

//funcion para buscar el codigo
$('#btnBuscar').click(function(e){
    $("#banner").fadeOut("slow");
    $("#bannerSuccess").fadeOut("slow");
    var txtCodigo = $('#txtCodigo').val();
    var idReunion = $('#hdIdReunion').val();

    e.preventDefault();
     var parametros = {
        "txtCodigo" : txtCodigo,
        "idReunion": idReunion
        };
        $.ajax({
            data:  parametros,
            url:   '{{ URL::route('getApoderado') }}',
            type:  'post',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (data) {
               if (data.indexOf('Error:')!=-1) {
                    $("#banner").fadeOut("slow");
                    $("#banner").fadeIn("slow");
                    $("#mensajeError").html(data);
                    $("#hdIdPersona").val('');
               }else{

                    $("#txtDescPersona").val(data);
                    $("#hdIdPersona").val(txtCodigo);
                    $('#btnRegistrar').attr("disabled", false);

               }
            }
        });

});


//esto es para registrarla asistencia
$('#btnRegistrar').click(function(e){
    $("#banner").fadeOut("slow");
    var codigo = $('#hdIdPersona').val();
    var idReunion = $('#hdIdReunion').val();

    e.preventDefault();
     var parametros = {
        "codigo" : codigo,
        "idReunion": idReunion
        };
     if( parseInt(codigo)>= 1){
        $.ajax({
            data:  parametros,
            url:   '{{ URL::route('newAsistencia') }}',
            type:  'post',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (data) {
                if (data.indexOf('Error:')!=-1) {
                    $("#banner").fadeOut("slow");
                    $("#banner").fadeIn("slow");
                    $("#mensajeError").html(data);
                    $("#hdIdPersona").val('');
                }else{

                   $("#banner").fadeOut("slow");
                   $("#bannerSuccess").fadeIn("slow");
                   $("#mensajeSuccess").html(data+' Apoderado Registrado ');
                   $('#btnRegistrar').attr("disabled", true);

                }
            }
        });

     }


});


$(document).ready(function(){
    //empieza con el boton de registrar en disable
   $('#btnRegistrar').attr("disabled", true);
    //inicia con el focus en el texto
   $( "#txtCodigo" ).focus();


   //para mandar defrente el buscar


   $("#txtCodigo").keyup(function(){

    if(this.value.length==8){
        buscarDNI();
    }

   });

});


</script>




@stop