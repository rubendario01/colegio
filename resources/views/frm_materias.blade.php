@extends('plantilla2')

@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTION MATERIAS</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nueva_materia" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i> Nuevo</button>
            </div>
            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($materias as $materia)
                  <tr class="fila-materia">
                        <td>{{$materia->id}}</td>
                        <td>{{$materia->nombre}}</td>
                        <td>
                            <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                            <form action="/materias/eliminar" method="post" style="display:inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$materia->id}}">
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
      
      <form method="post" action="/materias/guardar">
        @csrf
        <input type="hidden" id="id" name="id" value="">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Materia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la materia">
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
          $('#nueva_materia').on('click', function(){
              console.log('click');
              $("#nombre").val('');
              $("#id").val(0);
              $("#modal_guardar").modal("show");
              $("#btn_guardar").html("Guardar");
          })
  
          $('.editando').on('click', function(){
              // Obtener la fila padre del enlace de edición
              var fila = $(this).closest('.fila-materia');
  
              // Obtener los valores de cada columna de la fila
              var id = fila.find('td:eq(0)').text();
              var nombre = fila.find('td:eq(1)').text();
  
              console.log('click');
              $("#nombre").val(nombre);
              $("#id").val(id);
              $("#modal_guardar").modal("show");
              $("#btn_guardar").html("Modificar");
          })
        });
  </script>
@endsection
