@extends('layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Formulario de Registro -  <small>Apoderado</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>

    <div class="row-fluid" id="banner" style="display: none">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-info-circle"></i>  <strong id="mensajeError"></strong>
        </div>
    </div>


    <div class="panel panel-yellow">
      <div class="panel-heading">Datos del Apoderado</div>
      <div class="panel-body">
      <form action="">
        <div class="row-fluid">
            <div class="col-lg-4">
                <div class="form-group txtNombre">
                    <label for="nombre">Nombre</label>
                    <input value="{{{ $persona->nombre or '' }}}" class="form-control" type="text" name="nombre" id="txtNombre" required/>
                    <input id="htxtId" type="hidden" value="{{{$persona->id or ''}}}"/>
               </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group txtApellidoP">
                    <label for="apellidoP">Apellido Paterno</label>
                    <input value="{{{ $persona->apellidoP or '' }}}" class="form-control" type="text" name="apellidoP" id="txtApellidoP" required/>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group txtApellidoM">
                    <div class="form-group">
                        <label for="apellidoM">Apellido Materno</label>
                        <input value="{{{ $persona->apellidoM or '' }}}" class="form-control" type="text" name="apellidoM" id="txtApellidoM" required/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="col-lg-2">
                <div class="form-group txtDni">
                    <label for="dni">DNI</label>
                    <input value="{{{ $persona->dni or '' }}}" class="form-control" type="text" name="dni" id="txtDni" required/>
                 </div>

            </div>

            <div class="col-lg-3">
                <div class="form-group txtDireccion">
                    <label for="direccion">Direccion</label>
                    <input value="{{{ $persona->direccion or '' }}}" class="form-control" type="text" name="direccion" id="txtDireccion" required/>
                 </div>

            </div>
            <div class="col-lg-3">
                <div class="form-group txtCorreo">
                    <label for="correo">Correo</label>
                    <input value="{{{ $persona->correo or '' }}}" class="form-control" type="text" name="correo" id="txtCorreo" required/>
                </div>

            </div>
            <div class="col-lg-2">
                <div class="form-group txtTelefono">
                    <label for="telefono">Telefono</label>
                    <input value="{{{ $persona->telefono or '' }}}" class="form-control" type="text" name="telefono" id="txtTelefono" required/>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group txtCelular">
                    <label for="celular">Celular</label>
                    <input value="{{{ $persona->celular or '' }}}" class="form-control" type="text" name="celular" id="txtCelular" required/>
                </div>
            </div>

        </div>

        <div class="row-fluid">
            <div class="col-lg-4">
                <div class="form-group fFoto">
                    <label for="foto">Foto</label>
                    <input class="form-control" type="file" name="foto" id="fFoto" required/>
                </div>
            </div>

        </div>

        <div class="row-fluid">
            <div class="col-lg-12">
                <p>

                </p>
            </div>
        </div>
        </form>
      </div>
        <div class="panel panel-default">
             <div class="panel-heading">
               <h3 class="panel-title">Panel title</h3>
             </div>
             <div class="panel-body">
       <!--Aca es para el filtro -->

           <div class="row">
               <div class="col-lg-1">
                   <div class="form-group">
                       <label for="criterioText">Criterio</label>
                   </div>
               </div>
               <div class="col-lg-4">
                   <div class="form-group">
                        <input type="text" class="form-control input-sm" id="criterioText" placeholder="Eidelman ">
                   </div>
               </div>
               <div class="col-lg-2">
                   <div class="form-group">
                       <button id="btnBuscar" type="submit"  class="btn btn-default">Buscar</button>
                   </div>
               </div>
           </div>

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
             </div>
           </div>

      <div class="panel-footer">



      </div>
    </div>

    <div class="row-fluid">
        <h2>Tabla de Alumnos</h2>
        <table id="gridApoderado" class="table table-bordered">

                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th></th>
                </thead>
                <tbody>
                @if (isset($alumnos) )
                @foreach ($alumnos as $alumno)

                    <tr id="">
                    <td class="valor">{{ $alumno->id }}</td>
                    <td> {{ $alumno->nombre }} {{ $alumno->apellidoP }} {{ $alumno->apellidoM }}</td>
                    <td><button class="btn btn-danger eliminar"> Eliminar </button></td>
                    </tr>
                @endforeach
                @endif

                </tbody>
            </table>
    </div>

    <div class="row-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
            Opciones
            </div>
            <div class="panel-body">
                @if(isset($persona->id))
                    <input id="btnEditar" type="" value="Registrar" class="btn btn-success"/>
                @else
                    <input id="btnGuardar" type="" value="Registrar" class="btn btn-success"/>
                @endif

            </div>
        </div>
    </div>



<script>
       //para todos los eventos en el page
/*para agrega una tabla dinamicamente*/
  function agregar (id,nombre) {

    var buton = '<button class="btn btn-danger eliminar"> Eliminar </button>';

    var bandera = buscarId(id);
    if(bandera == 1){
        alert('El Alumno ya a sido ingresado')
    }else
    $('#gridApoderado > tbody:last').append('<tr id=""><td class="valor">'+id+'</td> <td>'+nombre+'</td><td>'+buton+'</td></tr>');

  }

  function buscarId(id){
    var bandera =0;
    $('#gridApoderado tbody  tr').each(function() {

    	var customerId = $(this).find(".valor").html();

        if(id == parseInt(customerId)){
            bandera =1;
        }
    });

    return bandera;
  }


  $(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(1);
	$(parent).remove();
    //console.log(parent);
    });
//===== termina los eventos del cargado de la tabla dinamica




    //estyo acciona el boton buscar y para el primer load
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

    //validacion para ver si los datos estan correctos

    function validacion(){

        var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var expr1 = /^[a-zA-Z]*$/;
        var expreNum = /^[0-9]*$/;

        var mensaje = 'Error en :';
        var bandera= 0;
        //aca colocamo todos los comparables
        var txtDni = $('#txtDni').val();
        var txtApellidoP = $('#txtApellidoP').val();
        var txtApellidoM = $('#txtApellidoM').val();
        var txtNombre = $('#txtNombre').val();
        var txtDireccion = $('#txtDireccion').val();
        var txtCorreo = $('#txtCorreo').val();
        var txtTelefono = $('#txtTelefono').val();
        var txtCelular = $('#txtCelular').val();
        var fFoto = $('#fFoto').val();


        //Las condiciones para la validacion

        if( txtNombre  == '' || txtNombre .length > 20 ){
            mensaje += 'El campo Nombre, es Obligatorio y menor a 20 caracteres'+' <br>';
            bandera=1;
            $( ".txtNombre" ).addClass( "has-error" );
        }else
            $( ".txtNombre" ).removeClass( "has-error" ).addClass( "has-success" );
        if( txtApellidoP == '' || txtApellidoP.length > 20 ){
            mensaje += 'El campo Apellido Paterno, es Obligatorio y menor a 20 caracteres'+' <br>';
            bandera=1;
            $( ".txtApellidoP" ).addClass( "has-error" );
        }else
            $( ".txtApellidoP" ).removeClass( "has-error" ).addClass( "has-success" );
        if( txtApellidoM == '' || txtApellidoM.length > 20 ){
            mensaje += 'El campo Apellido Materno, es Obligatorio y menor a 20 caracteres'+' <br>';
            bandera=1;
            $( ".txtApellidoM" ).addClass( "has-error" );
        }else
            $( ".txtApellidoM" ).removeClass( "has-error" ).addClass( "has-success" );
        if( txtDni == '' || txtDni.length != 8 ){
            mensaje += 'El campo DNI, es Obligatorio e igual a 8 digitos'+' <br>';
            bandera=1;
            $( ".txtDni" ).addClass( "has-error" );
        }else
            $( ".txtDni" ).removeClass( "has-error" ).addClass( "has-success" );
        if( txtDireccion  == ''  ){
            mensaje += 'El campo Direccion, es Obligatorio '+' <br>';
            bandera=1;
            $( ".txtDireccion" ).addClass( "has-error" );
        }else
            $( ".txtDireccion" ).removeClass( "has-error" ).addClass( "has-success" );
        if( txtCorreo == '' || !expr.test(txtCorreo) ){
            mensaje += 'El campo Correo, es Obligatorio y tener el formato example@asd.com'+' <br>';
            bandera=1;
            $( ".txtCorreo" ).addClass( "has-error" );
        }else
            $( ".txtCorreo" ).removeClass( "has-error" ).addClass( "has-success" );
        if( txtCelular == '' || !expreNum.test(txtCelular) || txtCelular.length > 11 ||txtCelular.length < 6 ){
            mensaje += 'El campo Celular, es Obligatorio y entre 6-11 digitos'+' <br>';
            bandera=1;
            $( ".txtCelular" ).addClass( "has-error" );
        }else
        $( ".txtCelular" ).removeClass( "has-error" ).addClass( "has-success" );

        /*
        if( fFoto == '' ){
            mensaje += 'El campo Foto, es Obligatorio'+' <br>';
            bandera=1;
            $( ".fFoto" ).removeClass( "has-error" ).addClass( "has-error" );
        }else
        $( ".fFoto" ).removeClass( "has-error" ).addClass( "has-success" );
        */

        //esta es la condicion que valida si hay errores
        if(bandera == 1){
            alert('Hay errores enm el ingreso');
            $("#banner").fadeIn("slow");
            $("#mensajeError").html(mensaje);
            $('html, body').animate({
                       scrollTop: '0px'
                   },
                   1100)
        }

        //al final retorna  bandera 1 es que hay errores , 0 es que no hay errores
        return bandera;
    }

    //================= para hallar todos los hijos apoderados ==================

    function getAlumnos(){
        var  Alumnos =[];
        $('#gridApoderado tbody  tr').each(function() {
            var customerId = $(this).find(".valor").html();
            Alumnos.push(customerId);
        });

        return Alumnos;
    }


    $(document).ready(function (){

        /*para el boton guardar*/

        $("#btnGuardar").click(function(e) {
            e.preventDefault();

            //primero llamasos a la vaidacion

           var bandera = validacion();
            if(bandera==0){
                var inputFileImage = document.getElementById('fFoto');
                var file = inputFileImage.files[0];
                var formData = new FormData();
            //traermos primero al array de alumnos
                var alumnos = getAlumnos();
                if(alumnos.length>0){
                    formData.append('alumnos',alumnos);

                }
                 formData.append('nombre', $('#txtNombre').val());
                 formData.append('apellidoP', $('#txtApellidoP').val());
                 formData.append('apellidoM', $('#txtApellidoM').val());
                 formData.append('dni', $('#txtDni').val());
                 formData.append('direccion', $('#txtDireccion').val());
                 formData.append('correo', $('#txtCorreo').val());
                 formData.append('telefono', $('#txtTelefono').val());
                 formData.append('celular', $('#txtCelular').val());
                 formData.append('foto',file);


                 var ruta = "{{ URL::route('regApoderado') }}";
                 $.ajax({
                    url: ruta,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(datos)
                        {
                            if (datos.indexOf('Error:')!=-1) {
                                 $("#banner").fadeOut("slow");
                                 $("#banner").fadeIn("slow");
                                 $("#mensajeError").html('Error: no se a podido Guardar a la persona');
                            }else{

                                alert('Datos Guardados correctamente ');
                                location.href= rutaRetorno();

                            }
                            //$("#resultado").html(datos);
                        }
                    });
            }

        });

//============ aca es elevento para el editar


    $("#btnEditar").click(function(e) {
        e.preventDefault();
            //primero llamasos a la vaidacion
        var bandera = validacion();
        if(bandera==0){
            var inputFileImage = document.getElementById('fFoto');
            var file = inputFileImage.files[0];
            var formData = new FormData();
            //traermos primero al array de alumnos
            var alumnos = getAlumnos();
            if(alumnos.length>0){
                formData.append('alumnos',alumnos);

            }
            formData.append('id', $('#htxtId').val());
            formData.append('nombre', $('#txtNombre').val());
            formData.append('apellidoP', $('#txtApellidoP').val());
            formData.append('apellidoM', $('#txtApellidoM').val());
            formData.append('dni', $('#txtDni').val());
            formData.append('direccion', $('#txtDireccion').val());
            formData.append('correo', $('#txtCorreo').val());
            formData.append('telefono', $('#txtTelefono').val());
            formData.append('celular', $('#txtCelular').val());
            formData.append('foto',file);

            var ruta = "{{ URL::route('update_apoderado') }}";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                    {
                        if (datos.indexOf('Error:')!=-1) {
                            $("#banner").fadeOut("slow");
                            $("#banner").fadeIn("slow");
                            $("#mensajeError").html('Error: no se a podido Guardar a la persona');
                        }else{
                            alert('Datos Guardados correctamente ');
                            location.href= rutaRetorno();
                            }
                            //$("#resultado").html(datos);
                    }
            });
        }

    });



//============== aca termina el boton guardar para el editar


       /* Valida el tamaño maximo de un archivo adjunto */
       $('#fFoto').change(function (){

         var sizeByte = this.files[0].size;
         var siezekiloByte =(sizeByte / 1024);

         if(siezekiloByte > 1900){
             alert('El tamaño supera el limite permitido');
             $(this).val('');
         }
       });

       $('#txtDni').focusout(function(){

            var dni = this.value;

            var parametros = {
                "dni" : $('#txtDni').val()
            };

            $.ajax({
                url: "{{ URL::route('getDniPersona') }}",
                type: "POST",
                data: parametros,
                success: function(datos)
                    {
                        if (datos.indexOf('Error:')!=-1) {
                            $("#banner").fadeOut("slow");
                            $("#banner").fadeIn("slow");
                            $("#mensajeError").html('Error: el DNI no puede ser duplicado');
                            $('#txtDni').val('');
                        }else{

                            console.log(datos)

                        }
                            //$("#resultado").html(datos);
                    }
            });


       });

    });



    function rutaRetorno(){

        var ruta = "{{ URL::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Apoderado','criterio'=>'*')) }}";

        //return ruta;

        return ruta;
     }


    </script>

@endsection                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               