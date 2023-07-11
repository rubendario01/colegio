@extends('plantilla2')

@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTION DOCENTES</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nuevo_docente" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i> Nuevo</button>
            </div>
            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Sexo</th>
                        <th>Dirección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Teléfono</th>
                        <th>Profesión</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($docentes as $docente)
                  <tr class="fila-docente">

                        <td>{{$docente->id}}</td>
                        <td>{{$docente->codigo}}</td>
                        <td>{{$docente->nombres}}</td>
                        <td>{{$docente->apellidos}}</td>
                        <td>{{$docente->sexo}}</td>
                        <td>{{$docente->direccion}}</td>
                        <td>{{$docente->fecha_nac}}</td>
                        <td>{{$docente->telefono}}</td>
                        <td>{{$docente->profesion}}</td>
            
                        <td>
                            <input type="hidden" value="{{$docente->sexo}}">
                            <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                            <form action="/docentes/eliminar" method="post" style="display:inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$docente->id}}">
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
      
      <form method="post" action="/docentes/guardar">
        @csrf
        <input type="hidden" id="id" name="id" value="">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Docente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
            <div class="mb-3">
              <label for="codigo" class="form-label">Código:</label>
              <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el código del docente">
            </div>
            <div class="mb-3">
              <label for="nombres" class="form-label">Nombres:</label>
              <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese los nombres del docente">
            </div>
            <div class="mb-3">
              <label for="apellidos" class="form-label">Apellidos:</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese los apellidos del docente">
            </div>
            <div class="mb-3">
              <label for="sexo" class="form-label">Sexo:</label>
              <select class="form-control" id="sexo" name="sexo">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="direccion" class="form-label">Dirección:</label>
              <textarea class="form-control" id="direccion" name="direccion" placeholder="Ingrese la dirección del docente"></textarea>
            </div>
            <div class="mb-3">
              <label for="fecha_nac" class="form-label">Fecha de Nacimiento:</label>
              <input type="date" class="form-control" id="fecha_nac" name="fecha_nac">
            </div>
            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono:</label>
              <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono del docente">
            </div>
            <div class="mb-3">
              <label for="profesion" class="form-label">Profesión:</label>
              <input type="text" class="form-control" id="profesion" name="profesion" placeholder="Ingrese la profesión del docente">
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
          $('#nuevo_docente').on('click', function(){
              console.log('click');
              $("#codigo").val('');
              $("#nombres").val('');
              $("#apellidos").val('');
              $("#sexo").val('Masculino');
              $("#direccion").val('');
              $("#fecha_nac").val('');
              $("#telefono").val('');
              $("#profesion").val('');
              $("#id").val(0);
              $("#modal_guardar").modal("show");
              $("#btn_guardar").html("Guardar");
          })
  
          $('.editando').on('click', function(){
              // Obtener la fila padre del enlace de edición
              var fila = $(this).closest('.fila-docente');
  
              // Obtener los valores de cada columna de la fila
              var id = fila.find('td:eq(0)').text();
              var codigo = fila.find('td:eq(1)').text();
              var nombres = fila.find('td:eq(2)').text();
              var apellidos = fila.find('td:eq(3)').text();
              var sexo = fila.find('td:eq(4)').text();
              var direccion = fila.find('td:eq(5)').text();
              var fecha_nac = fila.find('td:eq(6)').text();
              var telefono = fila.find('td:eq(7)').text();
              var profesion = fila.find('td:eq(8)').text();
  
              console.log('click');
              $("#codigo").val(codigo);
              $("#nombres").val(nombres);
              $("#apellidos").val(apellidos);
              $("#sexo").val(sexo);
              $("#direccion").val(direccion);
              $("#fecha_nac").val(fecha_nac);
              $("#telefono").val(telefono);
              $("#profesion").val(profesion);
              $("#id").val(id);
              $("#modal_guardar").modal("show");
              $("#btn_guardar").html("Modificar");
          })
        })
  </script>
@endsection
