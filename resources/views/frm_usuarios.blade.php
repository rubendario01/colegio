@extends('plantilla2')
@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTION USUARIOS</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nuevo_usuario" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i> Nuevo</button>
            </div>
            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                  <tr class="fila-usuario">

                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->role}}</td>
                        <td style="display:none">{{$usuario->id_rol}}</td>
            
                        <td>
                            <input type="hidden"  value="{{$usuario->id_rol}}">
                            {{-- <a href="/editar_usuario?{{$usuario->id}}" class="btn btn-info editando_usuario"><i class="fas fa-pencil-alt text-white"></i></a> --}}
                            <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                            <form action="/usuarios/eliminar" method="post" style="display:inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$usuario->id}}">
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
      
      <form method="post" action="/usuarios/guardar">
        @csrf
        <input type="hidden" id="id" name="id" value="">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre">
            </div>
            <div class="mb-3">
              <label for="contraseña" class="form-label">Correo:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su contraseña">
            </div>
            <div class="mb-3">
              <label for="contraseña" class="form-label">Contraseña:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
            </div>
            <div class="mb-3">
              <label for="rol" class="form-label">Rol:</label>
              <select class="form-control" id="id_rol" name="id_rol">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">
                    {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
            </div>
          </div>
          <div class="modal-footer">
            <button id="btn_guardar"type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </form>
        
    </div>
  </div>

  <script>
        $('#nuevo_usuario').on('click', function(){
            console.log('click');
            $("#nombre").val('');
            $("#password").val('');
            $("#email").val('');
            $("#id_rol").val(0);
            $("#id").val(0);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Guardar");
 
        })

        $('.editando').on('click', function(){
                  // Obtener la fila padre del enlace de edición
            var fila = $(this).closest('.fila-usuario');

            // Obtener los valores de cada columna de la fila
            var id = fila.find('td:eq(0)').text();
            var nombre = fila.find('td:eq(1)').text();
            var correo = fila.find('td:eq(2)').text();
            var rol = fila.find('td:eq(3)').text();
            var id_rol = fila.find('td:eq(4)').text();
            console.log('click');
            $("#nombre").val(nombre);
            //$("#password").val(password);
            $("#email").val(correo);
            $("#id_rol").val(id_rol);
            $("#id").val(id);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Modiifcar");
 
        })
  </script>
@endsection
