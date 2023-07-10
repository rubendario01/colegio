@extends('plantilla2')

@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTIONES ESCOLARES</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nueva_gestion" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i> Nuevo</button>
            </div>
            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Año</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($gestiones as $gestion)
                  <tr class="fila-gestion">
                        <td>{{$gestion->id}}</td>
                        <td>{{$gestion->anio}}</td>
                        <td>{{$gestion->fecha_inicio}}</td>
                        <td>{{$gestion->fecha_fin}}</td>
                        <td>
                            <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                            <form action="/gestiones/eliminar" method="post" style="display:inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$gestion->id}}">
                                <button class="btn btn-danger"><i class="fas fa-trash text-white"></i></button>
                            </form>
                        </td>
                  </tr>
                @endforeach
                    <!-- Aquí puedes agregar más filas con datos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal_guardar" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      
      <form method="post" action="/gestiones/guardar">
        @csrf
        <input type="hidden" id="id" name="id" value="">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Gestión</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
            <div class="mb-3">
              <label for="anio" class="form-label">Año:</label>
              <input type="text" class="form-control" id="anio" name="anio" placeholder="Ingrese el año de la gestión">
            </div>
            <div class="mb-3">
              <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
              <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingrese la fecha de inicio">
            </div>
            <div class="mb-3">
              <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Ingrese la fecha de fin">
            </div>
          </div>
          <div class="modal-footer">
            <button id="btn_guardar" type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </form>
        
    </div>
  </div>

  <script>
        $('#nueva_gestion').on('click', function(){
            console.log('click');
            $("#anio").val('');
            $("#fecha_inicio").val('');
            $("#fecha_fin").val('');
            $("#id").val(0);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Guardar");
        })

        $('.editando').on('click', function(){
            // Obtener la fila padre del enlace de edición
            var fila = $(this).closest('.fila-gestion');

            // Obtener los valores de cada columna de la fila
            var id = fila.find('td:eq(0)').text();
            var anio = fila.find('td:eq(1)').text();
            var fecha_inicio = fila.find('td:eq(2)').text();
            var fecha_fin = fila.find('td:eq(3)').text();

            console.log('click');
            $("#anio").val(anio);
            $("#fecha_inicio").val(fecha_inicio);
            $("#fecha_fin").val(fecha_fin);
            $("#id").val(id);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Modificar");
        })
  </script>
@endsection
