<div class="row" id="contProfile">
    <div class="row" style="" id="ligaNombre">
        {{ $persona->nombre }}, {{ $persona->apellidoP }} {{ $persona->apellidoM }}
    </div>

    <div class="col-lg-4 imgAvatar">
    <img class="" src="{{ asset('imagenes/profiles') }}/{{ $persona->foto }}" alt="" width="169px"/>

    </div>
    <div class="col-lg-8" id="viewProfile" style="font-size: 15px;">

        <div class="row" >
            <div class="col-lg-6">
                <strong class="helpStrong1">Id: </strong> <br/>
                <input type="text" class="form-control input-sm" value=" {{ $persona->id }}" readonly/>
            </div>
            <div class="col-lg-6">
                <strong class="helpStrong1">DNI: </strong><br/>
                <input type="text" class="form-control input-sm"  value=" {{ $persona->dni }}" readonly/>
            </div>
        </div>
        <div class="row" >
            <div class="col-lg-6">
                <strong class="helpStrong1">Direccion: </strong> <br/>
                <input type="text" class="form-control input-sm" value="{{ $persona->direccion }}" readonly/>

            </div>
            <div class="col-lg-6">
                <strong class="helpStrong1">Correo: </strong> <br/>
                 <input type="text" class="form-control input-sm" value="{{ $persona->correo }}" readonly/>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                 <strong class="helpStrong1">Apoderado: </strong> <br/>
                 <input type="text" class="form-control input-sm" value="{{ $persona->apoderado->nombre or 'No tiene' }}" readonly/>

            </div>
            <div class="col-lg-3">
                <strong class="helpStrong1">Telefono: </strong><br/>
                <input type="text" class="form-control input-sm" value="{{ $persona->telefono }}" readonly/>

            </div>
            <div class="col-lg-3">
                <strong class="helpStrong1">Celular: </strong><br/>
                <input type="text" class="form-control input-sm" value="{{ $persona->celular }}" readonly/>

            </div>
        </div>

        @if ( $persona->tipo == 'Apoderado')
        <div class="row">
        <strong class="helpStrong1">Estado: </strong><br/>
            @if ( $persona->estado == true)
            <input type="text" class="form-control input-sm" value="Habil" readonly/>
            @else
            <input type="text" class="form-control input-sm" value="En Baja" readonly/>
            @endif

        </div>
        <br/>
         <div class="row" style="color: #000000">
            <div class="col-lg-12">
            <ul class="list-group">
            <li class="list-group-item active">Lista de Hijos
             <span class="badge">{{ count($persona->hijos)  }} </span>
             </li>
            @foreach($persona->hijos as $hijo)

            <li class="list-group-item">{{$hijo->nombre}} | {{$hijo->nivel}},{{$hijo->grado}},{{$hijo->seccion}}</li>

            @endforeach
            </ul>
            </div>
         </div>

         @else
         <div class="row">
            <div class="col-lg-4">
                <strong class="helpStrong1">Nivel </strong><br/>
                <input type="text" class="form-control input-sm" value="{{ $persona->nivel }}" readonly/>
            </div>
            <div class="col-lg-2">
                <strong class="helpStrong1">Grado </strong><br/>
                <input type="text" class="form-control input-sm" value="{{ $persona->grado }}" readonly/>
            </div>
            <div class="col-lg-2">
                <strong class="helpStrong1">Seccion </strong><br/>
                <input type="text" class="form-control input-sm" value="{{ $persona->seccion }}" readonly/>
            </div>
         </div>
         @if($persona->apoderado != null)
         <div class="row">
            <div class="col-lg-12">


            <strong class="helpStrong1">Apoderado </strong><br/>
            <input type="text" class="form-control input-sm" value="{{$persona->apoderado->name}}" readonly/>
            </div>

         </div>
         @endif


        @endif



    </div>
</div>
<div id="">
    <img class="logoProfile" src="{{ asset('imagenes/adds/logo.png') }}" alt="" />
</div>