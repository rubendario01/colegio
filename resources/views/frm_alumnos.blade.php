@extends('plantilla2')
@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTION ALUMNOS</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nuevo_alumno" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i>
                    Nuevo</button>
            </div>
            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Rude</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Sexo</th>
                        <th>Dirección</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                    <tr class="fila-alumno">

                        <td>{{$alumno->id}}</td>
                        <td>{{$alumno->ci_alumno}}</td>
                        <td>{{$alumno->nombre}}</td>
                        <td>{{$alumno->apellidos}}</td>
                        <td>{{$alumno->rude}}</td>
                        <td>{{$alumno->fecha_nac}}</td>
                        <td>{{$alumno->sexo}}</td>
                        <td>{{$alumno->direccion}}</td>

                        <td>
                            <input type="hidden" value="{{$alumno->sexo}}">
                            {{-- <a href="/editar_alumno?{{$alumno->id}}" class="btn btn-info editando_alumno"><i
                                class="fas fa-pencil-alt text-white"></i></a> --}}
                            <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                            <form action="/alumnos/eliminar" method="post" style="display:inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$alumno->id}}">
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
<div id="modal_guardar" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">

        <form method="post" action="/alumnos/guardar">
            @csrf
            <input type="hidden" id="id" name="id" value="">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Alumno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <div class="mb-3">
                        <label for="ci_alumno" class="form-label">CI:</label>
                        <input type="text" class="form-control" id="ci_alumno" name="ci_alumno"
                            placeholder="Ingrese el CI del alumno">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Ingrese el nombre del alumno">
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                            placeholder="Ingrese los apellidos del alumno">
                    </div>
                    <div class="mb-3">
                        <label for="rude" class="form-label">Rude:</label>
                        <input type="text" class="form-control" id="rude" name="rude"
                            placeholder="Ingrese el RUDE del alumno">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nac" class="form-label">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="fecha_nac" name="fecha_nac">
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
                        <textarea class="form-control" id="direccion" name="direccion"
                            placeholder="Ingrese la dirección del alumno"></textarea>
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
    $('#nuevo_alumno').on('click', function () {
        console.log('click');
        $("#ci_alumno").val('');
        $("#nombre").val('');
        $("#apellidos").val('');
        $("#rude").val('');
        $("#fecha_nac").val('');
        $("#sexo").val('Masculino');
        $("#direccion").val('');
        $("#id").val(0);
        $("#modal_guardar").modal("show");
        $("#btn_guardar").html("Guardar");
    })

    $('.editando').on('click', function () {
        // Obtener la fila padre del enlace de edición
        var fila = $(this).closest('.fila-alumno');

        // Obtener los valores de cada columna de la fila
        var id = fila.find('td:eq(0)').text();
        var ci_alumno = fila.find('td:eq(1)').text();
        var nombre = fila.find('td:eq(2)').text();
        var apellidos = fila.find('td:eq(3)').text();
        var rude = fila.find('td:eq(4)').text();
        var fecha_nac = fila.find('td:eq(5)').text();
        var sexo = fila.find('td:eq(6)').text();
        var direccion = fila.find('td:eq(7)').text();

        console.log('click');
        $("#ci_alumno").val(ci_alumno);
        $("#nombre").val(nombre);
        $("#apellidos").val(apellidos);
        $("#rude").val(rude);
        $("#fecha_nac").val(fecha_nac);
        $("#sexo").val(sexo);
        $("#direccion").val(direccion);
        $("#id").val(id);
        $("#modal_guardar").modal("show");
        $("#btn_guardar").html("Modificar");
    })

</script>
@endsection
