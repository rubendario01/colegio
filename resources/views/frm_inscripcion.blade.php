@extends('plantilla2')
@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTION INSCRIPCIONES</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nueva_inscripcion" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i>
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
                        <th>Grado</th>
                        <th>Turno</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos_inscritos as $alumno)
                    <tr class="fila-alumno">

                        <td>{{$alumno->id}}</td>
                        <td>{{$alumno->ci_alumno}}</td>
                        <td>{{$alumno->nombre}}</td>
                        <td>{{$alumno->apellidos}}</td>
                        <td>{{$alumno->rude}}</td>
                        <td>{{$alumno->grado}}</td>
                        <td>{{$alumno->turno}}</td>
        

                        <td>
                            
                            {{-- <a href="/editar_alumno?{{$alumno->id}}" class="btn btn-info editando_alumno"><i
                                class="fas fa-pencil-alt text-white"></i></a> --}}
                            <a href="#" class="btn btn-info editando" data-inscripcion="{{json_encode($alumno)}}"><i class="fas fa-pencil-alt text-white"></i></a>
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
    <div class="modal-dialog modal-xl">

        <form method="post" action="">
            
            <input type="hidden" id="id" name="id" value="">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inscripcion de alumnnos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <select id="id_alumno" class="form-control choices-single" style="font-size:2 rem !important">
                             
                                @foreach($alumnos as $alumno)
                                    <option value="{{json_encode($alumno)}}">{{$alumno->nombre .' '.$alumno->apellidos}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="ci_alumno" class="form-label">CI:</label>
                            <input type="text" class="form-control" id="ci_alumno" name="ci_alumno"
                                placeholder="Ingrese el CI del alumno">
                        </div>

                        <div class="col-md-4">
                            <label for="rude" class="form-label">Rude:</label>
                            <input type="text" class="form-control" id="rude" name="rude"
                                placeholder="Ingrese el RUDE del alumno">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nombre" class="form-label">Curso gestion:</label>
                            <select id="id_cursogestion" class="form-control choices-single" style="font-size:2 rem !important">
                             
                                @foreach($cursogestiones as $cursogestion)
                                    <option value="{{json_encode($cursogestion)}}">{{$cursogestion->grado .' - '.$cursogestion->anio}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="table-container">
                                <p class="fs-5">Materias que tiene el curso:</p>
                                
                                <table id="tablaSeleccionados_ver" class="table table-striped table-hover">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            {{-- <th>Opcion</th> --}}
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
                    <a id="btn_guardar" class="btn btn-primary">Guardar</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var datosSeleccionados_ver=[];
    var id_curso=0;
    var id_gestion=0;
    var id_alumno=0;
    var id_inscripcon=0;
    $(document).ready(function(){
        console.log('cargo');
        new Choices(document.querySelector(".choices-single"));
        new Choices(document.querySelector("#id_cursogestion"));
     
        $(document).on('click', '#nueva_inscripcion', function(){
            $('#modal_guardar').modal('show');
        });
        $('#id_alumno').on('change', function () {
            var alumno = JSON.parse($(this).val());
            console.log(alumno);
            $('#ci_alumno').val(alumno.ci_alumno);
            $('#rude').val(alumno.rude);
            id_alumno=alumno.id;
            console.log('id-alumno:', id_alumno);
            
        });

        $('#id_cursogestion').on('change', function () {
            var cursogestion = JSON.parse($(this).val());
            id_curso=cursogestion.id_curso;
            id_gestion=cursogestion.id_gestion;
            verMaterias();
            console.log(cursogestion);
           
            
        });
        $('#btn_guardar').on('click', function () {
            guardar();
            $('#modal_guardar').modal('hide');
        });

        $('.editando').on('click', function () {
            var inscripcion = $(this).data('inscripcion');
            console.log(inscripcion);
            id_inscripcon = inscripcion.id_inscripcon;
            id_alumno = inscripcion.id_alumno;
            id_curso = inscripcion.id_curso;
            id_gestion = inscripcion.id_gestion;
            textoSeleccionado=inscripcion.nombre+' '+inscripcion.apellidos;
            var choices = new Choices(document.querySelector("#id_cursogestion"));
            //$('#id_alumno option:contains("' + textoSeleccionado + '")').prop('selected', true);
            
            var optionValue = $(document.querySelector("#id_cursogestion")).find('option:contains("' + textoSeleccionado + '")').val();
            choices.setValue([optionValue]);

            $('#modal_guardar').modal('show');
        });
    });

    function guardar(){
            data={
                id_alumno,
                id_gestion,
                id_curso,
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            $.post('/inscripcion/guardar', data)
                .done(function (response) {
                    console.log('Respuesta exitosa:', response);
                    //$('#modal_editar_materias').modal('hide');
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

    function verMaterias(){
         
         var data = {
      
             id_curso,
             id_gestion,
             
         };
         datosSeleccionados_ver=[];
        
         $.get('/materiagestion/ver', data)
             .done(function (response) {
                 console.log('Respuesta exitosa:', response);
                 datosSeleccionados_ver = response;
             
                 
                 console.log(datosSeleccionados_ver);
               
                 actualizarTablaSeleccionados_ver();
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

        function actualizarTablaSeleccionados_ver() {
            var tablaSeleccionados = $('#tablaSeleccionados_ver tbody');
            tablaSeleccionados.empty();

            // Iterar sobre los datos seleccionados y agregar filas a la tabla
            for (var i = 0; i < datosSeleccionados_ver.length; i++) {
            var filaSeleccionada =
                '<tr>' +
               
                '<td>' + datosSeleccionados_ver[i].id + '</td>' +
                '<td>' + datosSeleccionados_ver[i].nombre + '</td>' +
      
                // '<td><button class="btn btn-danger btnEliminar" data-indice="' + i + '"><i class="fas fa-trash"></i></button></td>' +
                '</tr>';

            tablaSeleccionados.append(filaSeleccionada);
            }
        }
</script>
@endsection
