
<div class="row">
    <div class="col-lg-12">
    <table class="table table-hover">
        <tr>
            <th>id</th>
            <th>Nombres y apellidos</th>
            <th>Nivel | Grado  | Seccion</th>
            <th>DNI</th>
            <th>Opcion</th>
        </tr>
        @foreach ($personas as $persona)
        <tr>
              <td>{{ $persona->id }}</td>
              <td>{{$persona->name}}</td>
              <td>{{$persona->nivel}}|{{$persona->grado}}|{{$persona->seccion}}</td>
              <td>{{$persona->dni}}</td>
              <td><button class="btn btn-info" onclick="agregar('{{ $persona->id }}',
              '{{$persona->name}}')"> Agregar </button></td>
          </tr>
         @endforeach
    </table>

    {{ $personas->links() }}




    </div>
</div>


