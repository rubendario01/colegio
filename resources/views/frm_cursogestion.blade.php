@extends('plantilla2')
@section('content')

<div class="container-fluid px-4">
   
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">CURSOS x GESTION</h1>
    </div>
    {{-- @if(!empty($mensaje))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>{{$mensaje}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>      
    @endif --}}
    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <a href="/cursogestion/frm_guardar" id="nuevo_cursogestion" class="btn btn-primary text-white"><i
                        class="fas fa-plus text-white"></i> Nuevo</a>
            </div>
            {{-- <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>

                        <th>Grado</th>
                        <th>Nivel</th>
                        <th>Turno</th>
                        <th>Cupo</th>
                        <th>Año</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursogestiones as $cursogestion)
                    <tr class="fila-alumno">

                        <td>{{$cursogestion->grado}}</td>
            <td>{{$cursogestion->nivel}}</td>
            <td>{{$cursogestion->turno}}</td>
            <td>{{$cursogestion->cupo}}</td>
            <td>{{$cursogestion->anio}}</td>
            <td>{{$cursogestion->fecha_inicio}}</td>
            <td>{{$cursogestion->fecha_fin}}</td>
            <td style="display:none">{{$cursogestion->id_curso}}</td>
            <td style="display:none">{{$cursogestion->id_gestion}}</td>

            <td>
                <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                <form action="/cursogestion/eliminar" method="post" style="display:inline-block">
                    @csrf
                    <input type="hidden" name="id_curso" value="{{$cursogestion->id_curso}}">
                    <input type="hidden" name="id_gestion" value="{{$cursogestion->id_gestion}}">
                    <button class="btn btn-danger"><i class="fas fa-trash text-white"></i></button>
                </form>
            </td>
            </tr>
            @endforeach

            </tbody>
            </table> --}}

            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Año</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        {{-- <th>Estado</th> --}}
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                  
                    @foreach($cursogestiones as $cursogestion)
                    
                    <tr class="fila-cursogestion">

                        <td>{{$cursogestion->id}}</td>
                        <td>{{$cursogestion->anio}}</td>
                        <td>{{$cursogestion->fecha_inicio}}</td>
                        <td>{{$cursogestion->fecha_fin}}</td>
                        {{-- <td> --}}
                            {{-- @if($cursogestion->estado==0) --}}
                            {{-- {{$cursogestion->fecha_fin}} --}}


                            {{-- @endif --}}
                        {{-- </td> --}}
                        {{-- <td style="display: none" objeto="{{json_encode($cursogestion)}}"></td> --}}
                        <td>
                            {{-- <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a> --}}
                            {{-- @if(count($cursogestiones)==$contador)
                                <span class='badge bg-success' style='color:White;'>En proceso</span>
                            @endif --}}
                            <a href="#" class="btn btn-info editar" data-cursogestion_editar="{{json_encode($cursogestion)}}"><i
                                class="fas fa-pencil-alt text-white"></i></a>
                            <a href="#" class="btn btn-info ver" data-cursogestion="{{json_encode($cursogestion)}}"><i
                                    class="fas fa-eye text-white"></i></a>


                        </td>
                    </tr>
                    {{-- @php $contador=$contador+1 @endphp --}}
                    @endforeach
                    <!-- Aquí puedes agregar más filas con datos -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="modal_ver_cursogestion" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cursos de la gestión</h5>
                <button type="button" class="btn-close modal_cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-container">
                    <p class="fs-5">Cursos registrados en la gestión:</p>
                    
                    <table id="tablaSeleccionados" class="table table-striped table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Grado</th>
                                <th>Nivel</th>
                                <th>Turno</th>
                                <th>Cupo</th>
                                <th>Estado</th>
                                <th>Opción</th>
                                {{-- <th>Opcion</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary modal_cerrar" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar-->
<div id="modal_editar_cursogestion" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cursos de la gestión</h5>
                <button type="button" class="btn-close modal_cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-container">
                            <p class="fs-5">Cursos disponibles:</p>
                            <table class="table table-striped table-hover">
                                <thead class="bg-secondary text-white">
                                    <tr>
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
                                        <td style="display:none">{{$curso->id}}</td>
                                        <td>{{$curso->grado}}</td>
                                        <td>{{$curso->nivel}}</td>
                                        <td>{{$curso->turno}}</td>
                                        <td>{{$curso->cupo}}</td>
                                        <td>
                                            <a href="#" class="btn btn-success editando"><i class="fas fa-check text-white"></i></a>
                                        </td>
                                  </tr>
                                @endforeach
                                    <!-- Aquí puedes agregar más filas con datos -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-container">
                            <p class="fs-5">Cursos registrados en la gestión:</p>
                            
                            <table id="tablaSeleccionadosEditar" class="table table-striped table-hover">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>Grado</th>
                                        <th>Nivel</th>
                                        <th>Turno</th>
                                        <th>Cupo</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary modal_cerrar_editar" data-bs-dismiss="modal">cerrar</button>
                <button id="btn_guardar" type="button" class="btn btn-danger">guardar</button>
            </div>
        </div>

    </div>
</div>


{{-- <script>
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

</script> --}}
<script>
    var datosSeleccionados=[];
    var datosSeleccionados_editar=[];
    $(document).ready(function () {
        $(document).on('click', '.ver', function () {
           
            var cursogestion = $(this).data('cursogestion');
            console.log(cursogestion);
            $('#modal_ver_cursogestion').modal('show');
            verCursos(cursogestion);

        });

        $(document).on('click', '.editar', function () {
            var cursogestion = $(this).data('cursogestion_editar');
            console.log(cursogestion);
            $('#modal_editar_cursogestion').modal('show');
            editarCursos(cursogestion);
        });

        $(document).on('click', '#btn_guardar', function () {
            console.log(datosSeleccionados_editar);
            modificarCursos();
        });

        $(document).on('click', '.btnEliminar', function(){
            var indice = $(this).data('indice');
            console.log(datosSeleccionados_editar[indice].estado);
            if(datosSeleccionados_editar[indice].estado==0){
                alert('No se puede eliminar');
            }else{
                datosSeleccionados_editar.splice(indice, 1);
                mostrarEditar();
            }
        });

        $('.editando').click(function(e) {
            e.preventDefault();
            // Obtener la fila padre del enlace clicado
            var fila = $(this).closest('.fila-curso');
            // Obtener los datos de la fila
            var id = fila.find('td:eq(0)').text();
            var grado = fila.find('td:eq(1)').text();
            var nivel = fila.find('td:eq(2)').text();
            var turno = fila.find('td:eq(3)').text();
            var cupo = fila.find('td:eq(4)').text();
            var estado = 2;
            if(existeAgregadoCurso(id)){
                alert('el curso ya esta agregado');
            }else{
                // Crear un objeto con los datos de la fila seleccionada
                var datosFila = {
                id_curso: id,
                grado: grado,
                nivel: nivel,
                turno: turno,
                cupo: cupo,
                estado: estado,
                };
                // Agregar los datos al objeto de filas seleccionadas
                datosSeleccionados_editar.push(datosFila);
                // Actualizar la tabla con los datos seleccionados
                mostrarEditar();
            }
        });


        console.log('cargado');
    })
    function existeAgregadoCurso(curso){
        var resultado = false;
        for(let i=0; i<datosSeleccionados_editar.length; i++){
            if(curso==datosSeleccionados_editar[i].id_curso){
                resultado=true;
            }
        }
        return resultado;
    }
    function verCursos(gestion){
        data={
            id_gestion:gestion.id,

        };
        $.get('/cursogestion/ver', data)
            .done(function (response) {
                console.log('Respuesta exitosa:', response);
                datosSeleccionados=response;
                actualizarTablaSeleccionados();
                // Realiza acciones adicionales con la respuesta exitosa
            })
            .fail(function (error) {
                console.log('Error en la solicitud:', error.responseText);
                // Realiza acciones adicionales en caso de error en la solicitud
            })
            .always(function () {
                console.log('Finalización de la solicitud');
                // Realiza acciones adicionales al finalizar la solicitud, tanto en éxito como en error
            });
    }

    function editarCursos(gestion){
        data={
            id_gestion:gestion.id,
        };
        $.get('/cursogestion/editar', data)
            .done(function (response) {
                console.log('Respuesta exitosa:', response);
                datosSeleccionados_editar=response;
                mostrarEditar();
                // Realiza acciones adicionales con la respuesta exitosa
            })
            .fail(function (error) {
                console.log('Error en la solicitud:', error.responseText);
                // Realiza acciones adicionales en caso de error en la solicitud
            })
            .always(function () {
                console.log('Finalización de la solicitud');
                // Realiza acciones adicionales al finalizar la solicitud, tanto en éxito como en error
            });
    }

    function modificarCursos(){
        data={
            id_gestion:datosSeleccionados_editar[0].id_gestion,
            cursos:datosSeleccionados_editar,
            _token: $('meta[name="csrf-token"]').attr('content'),
        };
        $.post('/cursogestion/modificar', data)
            .done(function (response) {
                console.log('Respuesta exitosa:', response);
                $('#modal_editar_cursogestion').modal('hide');
            })
            .fail(function (error) {
                console.log('Error en la solicitud:', error.responseText);
                // Realiza acciones adicionales en caso de error en la solicitud
            })
            .always(function () {
                console.log('Finalización de la solicitud');
                // Realiza acciones adicionales al finalizar la solicitud, tanto en éxito como en error
            });
    }


    function actualizarTablaSeleccionados() {
            var tablaSeleccionados = $('#tablaSeleccionados tbody');
            tablaSeleccionados.empty();

            // Iterar sobre los datos seleccionados y agregar filas a la tabla
            for (var i = 0; i < datosSeleccionados.length; i++) {
                var filaSeleccionada=`
                <tr>
                    <td>${datosSeleccionados[i].grado}</td>
                    <td>${datosSeleccionados[i].nivel}</td>
                    <td>${datosSeleccionados[i].turno}</td>
                    <td>${datosSeleccionados[i].cupo}</td>
                    <td>${datosSeleccionados[i].estado==0?'<span class="badge bg-success" style="color:White;">Activo</span>': '<span class="badge bg-danger" style="color:White;">Inactivo</span>'}</td>
                    <td><div class="dropdown">
                    <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Estado
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        ${datosSeleccionados[i].estado == 0 ? '<li><a class="dropdown-item" href="#" onclick="desactivar(' + datosSeleccionados[i].id_curso + ', ' + datosSeleccionados[i].id_gestion + ')">Desactivar</a></li>' : '<li><a class="dropdown-item" href="#" onclick="activar(' + datosSeleccionados[i].id_curso + ', ' + datosSeleccionados[i].id_gestion + ')">Activar</a></li>' }
                    </ul>
                    </div></td>
                </tr>
            `;

            tablaSeleccionados.append(filaSeleccionada);
            }
    }

    function mostrarEditar() {
            var tablaSeleccionados = $('#tablaSeleccionadosEditar tbody');
            tablaSeleccionados.empty();

            // Iterar sobre los datos seleccionados y agregar filas a la tabla
            for (var i = 0; i < datosSeleccionados_editar.length; i++) {
            var filaSeleccionada =
                '<tr' +(datosSeleccionados_editar[i].estado==0 || datosSeleccionados_editar[i].estado==1? ' style="background-color:#FFCBC0"':'' )+'>'+
                
                '<td>' + datosSeleccionados_editar[i].grado + '</td>' +
                '<td>' + datosSeleccionados_editar[i].nivel + '</td>' +
                '<td>' + datosSeleccionados_editar[i].turno + '</td>' +
                '<td>' + datosSeleccionados_editar[i].cupo + '</td>' +
                '<td><button class="btn btn-danger btnEliminar" data-indice="' + i + '"><i class="fas fa-trash"></i></button></td>' +
                '</tr>';

            tablaSeleccionados.append(filaSeleccionada);
            }
    }

    function activar(id_curso, id_gestion){
        data={
            id_gestion,
            id_curso,
            _token: $('meta[name="csrf-token"]').attr('content'),
        };
        $.post('/cursogestion/activar', data)
            .done(function (response) {
                console.log('Respuesta exitosa:', response);

                verCursos({id:response.id_gestion});
                
            })
            .fail(function (error) {
                console.log('Error en la solicitud:', error.responseText);
                // Realiza acciones adicionales en caso de error en la solicitud
            })
            .always(function () {
                console.log('Finalización de la solicitud');
                // Realiza acciones adicionales al finalizar la solicitud, tanto en éxito como en error
            });
       
    }

    function desactivar(id_curso, id_gestion){
        data={
            id_gestion,
            id_curso,
            _token: $('meta[name="csrf-token"]').attr('content'),
        };
        $.post('/cursogestion/desactivar', data)
            .done(function (response) {
                console.log('Respuesta exitosa:', response);

                verCursos({id:response.id_gestion});
                
            })
            .fail(function (error) {
                console.log('Error en la solicitud:', error.responseText);
                // Realiza acciones adicionales en caso de error en la solicitud
            })
            .always(function () {
                console.log('Finalización de la solicitud');
                // Realiza acciones adicionales al finalizar la solicitud, tanto en éxito como en error
            });
       
    }

</script>
@endsection
