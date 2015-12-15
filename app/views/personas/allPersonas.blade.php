@extends('layout')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Personas <small> - Alumnos y Apoderados</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!--Aca es para el filtro -->

<div class="row">
    <div class="col-lg-12">
     <form class="form-inline">
          <div class="form-group">
            <label for="criterioText">Criterio</label>
            <input type="text" class="form-control" id="criterioText" placeholder="Eidelman ">
          </div>
          &nbsp; &nbsp;
          <div class="form-group">
            <label for="exampleInputEmail2">Tipo</label>
            <input type="email" class="form-control" id="txtTipo" placeholder="Alumno">
          </div>
          <button id="btnBuscar" type="submit"  class="btn btn-default">Buscar</button>
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

            </div>
        </div>



    </div>
</div>


<!--finaliza la tabla de las peronas-->

<script type="text/javascript">

	$(document).ready(function(){
        var txtCriterio  = $('#criterioText').val();
        var txtTipo  = $('#txtTipo').val();

        if(txtCriterio.length<1){
            getAllPeronas(1);
        }

        //esta es para el cargado de datos
        $("#btnBuscar").click(function(e) {

            e.preventDefault();
            var txtCriterio  = $('#criterioText').val();
            var txtTipo  = $('#txtTipo').val();

            realizaProceso(txtCriterio,txtTipo);
        });

	});

    function realizaProceso(txtCriterio, txtTipo){

            var parametros = {
                    "txtCriterio" : txtCriterio,
                    "txtTipo" : txtTipo
            };
            $.ajax({
                    data:  parametros,
                    url:   '{{ URL::route('person') }}',
                    type:  'post',
                    beforeSend: function () {
                            $("#resultado").html("Procesando, espere por favor...");
                    },
                    success:  function (data) {
                       $("#gridPersona").html(data);
                    }
            });
    }

    /*==================== PAGINATION =========================*/
    $(document).on('click','.pagination a', function(e){
        			e.preventDefault();
        			 var page = $(this).attr('href').split('page=')[1];
        			 var txtCriterio  = $('#criterioText').val();

        			  if(txtCriterio.length>=1){

                            getPersonasByCriterio(page);
                      }else
                            getAllPeronas(page);

        		});
    function getPersonasByCriterio(page){
            			$.ajax({
            				url: '{{ URL::route('person') }}/'+$('#criterioText').val()+'?page=' + page,
            				type:  'get'
            			}).done(function(data){
            				$("#gridPersona").html(data);
            			});
            		}

    function getAllPeronas(page){
        $.ajax({
            url: '{{ URL::route('person') }}'+'?page=' + page,
            type:  'post'
            }).done(function(data){
                $("#gridPersona").html(data);
             });
    }
</script>


@stop
