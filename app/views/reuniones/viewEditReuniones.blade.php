@extends('layout')

@section('content')
    <h1>Formulario de edicion de reunion </h1>


    {{ Form::model($reunione,['route' => 'editReunion','method' => 'PUT', 'role' => 'form']) }}

    <div class="row-fluid">
        <div class="form-group">
            {{ Form::hidden('id') }}

        </div>

    </div>

    <div class="row-fluid">
        <div class="col-lg-12">
                <div class="form-group">
                    {{ Form::label('descripcion','Descripcion') }}
                    {{ Form::text('descripcion', null, ['class' => 'form-control','required'=>'required']) }}
                    {{ $errors->first('descripcion','<p class=" btn-danger active">:message</p>') }}

                </div>
        </div>
    </div>

    <div class="row-fluid">
    <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('fecha','Fecha') }}
                {{ Form::text('fecha',null, ['class' => 'form-control','required'=>'required']) }}
                {{ $errors->first('fecha','<p class=" btn-danger active">:message</p>') }}

            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('hora','Hora limite de cierre') }}
                {{ Form::text('hora',null, ['class' => 'form-control','required'=>'required']) }}
                {{ $errors->first('apellidoM','<p class=" btn-danger active">:message</p>') }}

            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('multa','Multa') }}
                <div class="input-group">
                    <div class="input-group-addon" style="height: 30%">S/.</div>
                    {{ Form::text('multa', null, ['class' => 'form-control','required'=>'required','pattern' => '[0-9]{8}']) }}
                </div>
                {{ $errors->first('multa','<p class=" btn-danger active">:message</p>') }}
             </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="col-lg-12">
            <p>
                <input type="submit" value="Registrar" class="btn btn-success"/>
            </p>
        </div>

    </div>


    {{ Form::close() }}
<script>
    //esta funciona manda todo el inicio de la app
    $(document).ready(function(){
        $('#fecha').get(0).type = 'date';
        $('#hora').get(0).type = 'time';
        $('#multa').get(0).type = 'number';
        $('#multa').get(0).step = '0.01';



    });

</script>

@stop