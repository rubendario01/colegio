@extends('plantilla2')

@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTION CURSOS</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nuevo_curso" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i> Nuevo</button>
            </div>
            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Grado</th>
                        <th>Nivel</th>
                        <th>Turno</th>
                        <th>Cupo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cursos as $curso)
                  <tr class="fila-curso">
                        <td>{{$curso->id}}</td>
                        <td>{{$curso->grado}}</td>
                        <td>{{$curso->nivel}}</td>
                        <td>{{$curso->turno}}</td>
                        <td>{{$curso->cupo}}</td>
                        <td>
                            <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                            <form action="/cursos/eliminar" method="post" style="display:inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$curso->id}}">
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
      
      <form method="post" action="/cursos/guardar">
        @csrf
        <input type="hidden" id="id" name="id" value="">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Curso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
            <div class="mb-3">
              <label for="grado" class="form-label">Grado:</label>
              <input type="text" class="form-control" id="grado" name="grado" placeholder="Ingrese el grado del curso">
            </div>
            <div class="mb-3">
              <label for="nivel" class="form-label">Nivel:</label>
              <input type="text" class="form-control" id="nivel" name="nivel" placeholder="Ingrese el nivel del curso">
            </div>
            <div class="mb-3">
              <label for="turno" class="form-label">Turno:</label>
              <input type="text" class="form-control" id="turno" name="turno" placeholder="Ingrese el turno del curso">
            </div>
            <div class="mb-3">
              <label for="cupo" class="form-label">Cupo:</label>
              <input type="number" class="form-control" id="cupo" name="cupo" placeholder="Ingrese el cupo del curso">
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
        $(document).ready(function(){
          $('#nuevo_curso').on('click', function(){
            console.log('click');
            $("#grado").val('');
            $("#nivel").val('');
            $("#turno").val('');
            $("#cupo").val('');
            $("#id").val(0);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Guardar");
        })

        $('.editando').on('click', function(){
            // Obtener la fila padre del enlace de edición
            var fila = $(this).closest('.fila-curso');

            // Obtener los valores de cada columna de la fila
            var id = fila.find('td:eq(0)').text();
            var grado = fila.find('td:eq(1)').text();
            var nivel = fila.find('td:eq(2)').text();
            var turno = fila.find('td:eq(3)').text();
            var cupo = fila.find('td:eq(4)').text();

            console.log('click');
            $("#grado").val(grado);
            $("#nivel").val(nivel);
            $("#turno").val(turno);
            $("#cupo").val(cupo);
            $("#id").val(id);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Modificar");
        })
        })
       
  </script>
@endsection
