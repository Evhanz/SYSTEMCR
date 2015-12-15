
<div class="row">
    <div class="col-lg-12">
    <table class="table table-hover">
        <tr>
            <th>id</th>
            <th>Nombres y apellidos</th>
            <th>Direccion</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Celular</th>
            <th>Apoderado</th>
            <th>Codigo de Barras</th>
        </tr>
        @foreach ($personas as $persona)
        <tr>
              <td>{{ $persona->id }}</td>
              <td>{{ $persona->nombre }}
                  {{ $persona->apellidoM }}
                  {{ $persona->apellidoP }}</td>
              <td>{{ $persona->direccion }}</td>
              <td>{{ $persona->correo }}</td>
              <td>{{ $persona->telefono }}</td>
              <td>{{ $persona->celular }}</td>
              <td>{{{ $persona->apoderado->nombre or 'Apoderado' }}}</td>
              <td>{{{ $persona->fotocheck->codigo_barras or 'No asignado' }}}</td>
          </tr>
         @endforeach
    </table>







    </div>
</div>


