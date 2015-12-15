@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Edita tu info</h1>

            {{ Form::model($user,['route' => 'update_account','method' => 'PUT', 'role' => 'form']) }}

            <div class="form-group">
            {{ Form::hidden('id') }}
            </div>

            <div class="form-group">
                {{ Form::label('usuario','Usuario') }}
                {{ Form::text('usuario', null, ['class' => 'form-control']) }}
                {{ $errors->first('usuario','<p class=" btn-danger active">:message</p>') }}

            </div>
            <div class="form-group">
                {{ Form::label('email','Correo') }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
                {{ $errors->first('email','<p class=" btn-danger active">:message</p>') }}

            </div>
            <div class="form-group">
                {{ Form::label('password','Clave') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
                {{ $errors->first('password','<p class=" btn-danger active">:message</p>') }}

            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation','Repite su clave') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                {{ $errors->first('password_confirmation','<p class=" btn-danger active">:message</p>') }}

            </div>
            <div class="form-group">
                {{ Form::label('user_type','Tipo') }}
                {{ Form::select('user_type', array('usuario'=>'usuario','admin' => 'admin'),null,['class' => 'form-control']) }}
                {{ $errors->first('user_type','<p class=" btn-danger active">:message</p>') }}

            </div>
            <p>
                <input type="submit" value="Register" class="btn btn-success"/>
            </p>

            {{ Form::close() }}


            <p></p>
        </div>
    </div>
@endsection