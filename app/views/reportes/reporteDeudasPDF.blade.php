@extends('lreportes')

@section('content')
    <h1 id="titleRep">Reportes de deudas por inasistencias</h1>
    <small id="lineaIm">..............................................................................
    ...........................................................</small>
    <br>

    <div id="contVariables">
        Nivel: {{$valor[0]}} | Grado: {{ $valor[1] }} | Seccion: {{ $valor[2] }}
    </div>
    <fieldset class="groupList">
    <legend>Alumnos:</legend>
        @foreach($personas as $persona)
            <h3> * Alumno : {{$persona->name}}</h3>

            <ul class="listaP">
                <li>Apoderado: {{$persona->apoderado}}
                    <ul class="listS">
                        @foreach($persona->multas as $multa)
                            <li>Reunion: {{$multa->reunion->descripcion}}| Multa: S/.
                            <span class="danger">{{ $multa->multa }}</span></li>
                        @endforeach
                    </ul>

                </li>
            </ul>

        @endforeach
    </fieldset>






<style>

#contVariables{

    border: 1px solid #828282;
    border-radius: 3px;
    padding: 1em;
}

.danger{
    color: #b81900;
}

.groupList{
    border-radius: 4px;
    margin: 1em;
}

.listaP{
    margin-top: -10px;
    border: 1px solid #a6a6a6;
    border-radius: 5px;
    box-shadow: 10px 10px 5px #888888;
    background-color: #269abc;
    color: #ffffff;
}

.listS{

    border: 1px solid #a6a6a6;
    background-color: white;
    color: #808080;
}



#lineaIm{


}

#titleRep{
    padding-bottom: -30px;
    font-style: oblique;
}


</style>
@stop