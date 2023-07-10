@extends('plantilla2')
@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">CURSOS x GESTION</h1>
    </div>

    <div class="row">
        <div class="card p-3 mt-2">

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
                    <!--<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Buscar curso</label>
                                <div class="input-group border boder-secondary">

                                    <select id="id_curso" name="id_curso" class="select2 form-control">
                                        <option disable selected>selecciona un curso</option>
                                        @foreach($cursos as $curso)
                                        <option value="{{json_encode($curso)}}">{{$curso->grado}}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nivel</label>
                                <input type="text" name="nivel" id="nivel" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Turno</label>
                                <input type="text" name="turno" id="turno" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Cupo</label>
                                <input type="number" name="cupo" id="cupo" class="form-control">
                            </div>
                        </div>

                    </div>-->

                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Buscar gestión</label>
                                <div class="input-group border boder-secondary">

                                    <select id="id_gestion" name="id_gestion" class="select2 form-control">
                                        <option disable selected>selecciona una gestión</option>
                                        @foreach($gestiones as $gestion)
                                        <option value="{{json_encode($gestion)}}">{{$gestion->anio}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <button class="btn btn-primary"><i class="fas fa-search"></i></button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fecha inicio</label>
                                <input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fecha fin</label>
                                <input type="text" name="fecha_fin" id="fecha_fin" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <p class="fs-5">Cursos para agregar:</p>
                        
                        <table id="tablaSeleccionados" class="table table-striped table-hover">
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

            {{-- <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Buscar gestión</label>
                        <div class="input-group border boder-secondary">

                            <select id="id_gestion" name="id_gestion" class="select2 form-control">
                                <option disable selected>selecciona una gestión</option>
                                @foreach($gestiones as $gestion)
                                <option value="{{json_encode($gestion)}}">{{$gestion->anio}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Fecha inicio</label>
                        <input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Fecha fin</label>
                        <input type="text" name="fecha_fin" id="fecha_fin" class="form-control">
                    </div>
                </div>

            </div> --}}

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <a href="/cursogestion" class="btn btn-danger mr-2">Cancelar</a>
                        <button id="btn_guardar" class="btn btn-primary ms-2 text-white">Guardar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
{{-- <div id="modal_guardar" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
</div> --}}

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
    $(document).ready(function () {
        // var cursos = {!! $cursos !!}; // Obtener los datos de los cursos cargados en la vista
        // console.log(cursos);
        // $('#grado').on('keyup', function() {
        //     var query = $(this).val();
        //     var resultados = buscarCursos(cursos, query);
        //     mostrarCursos(resultados);
        // });

        // function buscarCursos(cursos, query) {
        //     return cursos.filter(function(curso) {
        //         return curso.grado.toLowerCase().includes(query.toLowerCase());
        //     });
        // }

        // function mostrarCursos(cursos) {
        //     var cursosHTML = '';
        //     $.each(cursos, function(key, curso) {
        //         cursosHTML += '<div>' +
        //             '<h4>' + curso.grado + '</h4>' +

        //             '</div>';
        //     });
        //     $('#cursos-disponibles').html(cursosHTML);
        // }
        var id_curso = 0;
        var id_gestion = 0;
        var datosSeleccionados = [];

        $('#id_curso').select2();
        $('#id_gestion').select2();

        $('#id_curso').on('change', function () {
            var curso = JSON.parse($(this).val());
            console.log(curso.nivel);
            id_curso = curso.id;
            $('#nivel').val(curso.nivel);
            $('#turno').val(curso.turno);
            $('#cupo').val(curso.cupo);
            console.log(id_curso);
            console.log(curso);
        });

        $('#id_gestion').on('change', function () {
            var gestion = JSON.parse($(this).val());
            console.log(gestion.anio);
            id_gestion = gestion.id;
            $('#fecha_inicio').val(gestion.fecha_inicio);
            $('#fecha_fin').val(gestion.fecha_fin);
        });

        // guardar
        $('#btn_guardar').on('click', function (e) {
            e.preventDefault();
            console.log('click');
            guardarCursoGestion();
            console.log(datosSeleccionados);
            console.log(id_gestion);
        });

        function guardarCursoGestion() {
            var data = {
                cursos:datosSeleccionados,
                id_gestion: id_gestion,
                _token: $('meta[name="csrf-token"]').attr('content'),
            };

            $.post('/cursogestion/guardar', data)
                .done(function (response) {
                    console.log('Respuesta exitosa:', response);
                    // Si deseas enviar el objeto completo, puedes convertirlo a una cadena JSON y codificarlo como parte de la URL
                    var cursogestiones = encodeURIComponent(JSON.stringify(response.cursogestiones));
                    var mensaje=response.mensaje;
                    var url = '/cursogestion?cursogestiones=' + cursogestiones+'&mensaje='+mensaje;
                    window.location.href = url;
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

            if(existeAgregadoCurso(id)){
                alert('el curso ya esta agregado');
            }else{
                // Crear un objeto con los datos de la fila seleccionada
                var datosFila = {
                id: id,
                grado: grado,
                nivel: nivel,
                turno: turno,
                cupo: cupo
                };
    
                // Agregar los datos al objeto de filas seleccionadas
                datosSeleccionados.push(datosFila);
    
                // Actualizar la tabla con los datos seleccionados
                actualizarTablaSeleccionados();
    
                // Opcional: Hacer otras acciones con los datos capturados
    
                // Limpiar la selección de la fila
                //fila.removeClass('fila-curso');
            }
        });

        // Función para actualizar la tabla de datos seleccionados
        function actualizarTablaSeleccionados() {
            var tablaSeleccionados = $('#tablaSeleccionados tbody');
            tablaSeleccionados.empty();

            // Iterar sobre los datos seleccionados y agregar filas a la tabla
            for (var i = 0; i < datosSeleccionados.length; i++) {
            var filaSeleccionada =
                '<tr>' +
               
                '<td>' + datosSeleccionados[i].grado + '</td>' +
                '<td>' + datosSeleccionados[i].nivel + '</td>' +
                '<td>' + datosSeleccionados[i].turno + '</td>' +
                '<td>' + datosSeleccionados[i].cupo + '</td>' +
                '<td><button class="btn btn-danger btnEliminar" data-indice="' + i + '"><i class="fas fa-trash"></i></button></td>' +
                '</tr>';

            tablaSeleccionados.append(filaSeleccionada);
            }
        }

        function existeAgregadoCurso(curso){
            var resultado = false;
            for(let i=0; i<datosSeleccionados.length; i++){
                if(curso==datosSeleccionados[i].id){
                    resultado=true;
                }
            }
            return resultado;
        }

        $(document).on('click', '.btnEliminar', function(){
            var indice = $(this).data('indice');
            datosSeleccionados.splice(indice, 1);
            actualizarTablaSeleccionados();
        });

    });

</script>
@endsection
