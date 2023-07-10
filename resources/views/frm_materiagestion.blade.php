@extends('plantilla2')
@section('content')
<style>
    /* Aplica el tamaño de la fuente personalizado a Choices.js */
    .choices-single .choices__input,
    .choices-single .choices__button {
      font-size: 3rem !important;
    }
  </style>
<div class="container-fluid px-4">
   
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">MATERIAS X CURSOS</h1>
    </div>
    
    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <a id="nuevo_materiagestion" class="btn btn-primary text-white"><i
                        class="fas fa-plus text-white"></i> Nuevo</a>
            </div>
         

            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                     
                        <th>Grado</th>
                        <th>Nivel</th>
                        <th>Turno</th>
                        <th>Año</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursogestiones as $cursogestion)
                    <tr class="fila-cursogestion">
                        <td>{{$cursogestion->grado}}</td>
                        <td>{{$cursogestion->nivel}}</td>
                        <td>{{$cursogestion->turno}}</td>
                        <td>{{$cursogestion->anio}}</td>
                       
                        <td>
                      
                            <a href="#" class="btn btn-info editar" data-cursogestioneditar="{{json_encode($cursogestion)}}"><i
                                class="fas fa-pencil-alt text-white"></i></a>
                            <a href="#" class="btn btn-info ver" data-cursogestion="{{json_encode($cursogestion)}}"><i
                                    class="fas fa-eye text-white"></i></a>
                        </td>
                    </tr>
                    @endforeach
               
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="modal_ver_materias" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Materias del curso</h5>
                {{-- <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Guardar-->
<div id="modal_materias" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cursos de la gestión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <!--<div class="form-group">
                            <label class="fs-5 mb-3" for="">Gestión</label>
                            <select id="id_aniogestion" class="form-control choices-single" style="font-size:2 rem !important">
                             
                                @foreach($aniosgestiones as $aniogestion)
                                    <option value="{{json_encode($aniogestion)}}">{{$aniogestion->anio}}</option>
                                @endforeach
                            </select>
                        </div>-->
                        <div class="form-group">
                            <label class="fs-5 mb-3" for="">Buscar curso x gestión</label>
                            <select id="id_cursoxgestion" class="form-control choices-single" style="font-size:2 rem !important">
                             
                                @foreach($cursoxgestiones as $cursoxgestion)
                                    <option value="{{json_encode($cursoxgestion)}}">{{$cursoxgestion->anio.' - '.$cursoxgestion->grado .' - '.$cursoxgestion->nivel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div class="table-container">
                            <p class="fs-5">Materias disponibles:</p>
                        
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
                                            <a href="#" class="btn btn-success guardando"><i class="fas fa-check text-white"></i></a>
                                        </td>
                                  </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-container">
                            <p class="fs-5">Materias seleccionadas</p>
                            
                            <table id="tablaSeleccionados" class="table table-striped table-hover">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
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


<!-- Modal Editar-->
<div id="modal_editar_materias" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cursos de la gestión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label class="fs-5 mb-3" for="">Buscar curso x gestión</label>
                            <select id="id_cursoxgestion" class="form-control choices-single" style="font-size:2 rem !important">
                                @foreach($cursoxgestiones as $cursoxgestion)
                                    <option value="{{json_encode($cursoxgestion)}}">{{$cursoxgestion->grado .' - '.$cursoxgestion->nivel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br> --}}

                        <div class="table-container">
                            <p class="fs-5">Materias disponibles:</p>
                        
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
                                            <a href="#" class="btn btn-success editando"><i class="fas fa-check text-white"></i></a>
                                        </td>
                                  </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-container">
                            <p class="fs-5">Materias seleccionadas</p>
                            
                            <table id="tablaSeleccionados_editar" class="table table-striped table-hover">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>IDD</th>
                                        <th>Nombre</th>
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
                <button id="btn_modificar" type="button" class="btn btn-danger">guardar</button>
            </div>
        </div>
    </div>
</div>



<script>
    var datosSeleccionados=[];
    var datosSeleccionados_ver=[];
    var datosSeleccionados_editar=[];
    var selectSeleccionados=[];
    // Propiedades
    var id_curso=0;
    var id_gestion=0;
    var id_materia=0;
    $(document).ready(function () {
        $(document).on('click', '#nuevo_materiagestion', function(e){
            e.preventDefault();
            $('#modal_materias').modal('show');
            new Choices(document.querySelector("#id_cursoxgestion"));
            new Choices(document.querySelector("#id_aniogestion"));
            console.log('click');
            datosSeleccionados=[];
            actualizarTablaSeleccionados();
        });

        $('#id_cursoxgestion').on('change', function () {
            var curso = JSON.parse($(this).val());
            console.log(curso);
            id_curso = curso.id_curso;
            id_gestion = curso.id_gestion;
            console.log(id_curso, id_gestion);
            // $('#nivel').val(curso.nivel);
            // $('#turno').val(curso.turno);
            // $('#cupo').val(curso.cupo);
            // console.log(id_curso);
            // console.log(curso);
        });
        $('#id_aniogestion').on('change', function () {
            var aniogestion = JSON.parse($(this).val());
            console.log(aniogestion);
            verCursosGestion(aniogestion.id_gestion);

        });

        $(document).on('click', '.btnEliminar', function(){
            var indice = $(this).data('indice');
            datosSeleccionados.splice(indice, 1);
            datosSeleccionados_editar.splice(indice, 1);
            actualizarTablaSeleccionados();
            actualizarTablaSeleccionados_editar();
        });

        $(document).on('click', '#btn_guardar', function(){
            console.log(datosSeleccionados);
            console.log(id_curso, id_gestion);
            guardar();
        });

        $(document).on('click', '#btn_modificar', function(){
            console.log(datosSeleccionados_editar);
            console.log(id_curso, id_gestion);
            modificar();
        });

        $(document).on('click', '.ver', function(){
            
            var cursogestion = $(this).data('cursogestion');
            id_materia = cursogestion.id_materia;
            id_curso = cursogestion.id_curso;
            id_gestion = cursogestion.id_gestion;
            console.log(id_materia, id_curso, id_gestion);
            verMaterias();
            actualizarTablaSeleccionados_ver();
            $('#modal_ver_materias').modal('show');
            console.log('ver');
        });

        $(document).on('click', '.editar', function(){
            
            var cursogestion = $(this).data('cursogestioneditar');
            id_materia = cursogestion.id_materia;
            id_curso = cursogestion.id_curso;
            id_gestion = cursogestion.id_gestion;
            console.log(id_materia, id_curso, id_gestion);
            verMaterias();
            actualizarTablaSeleccionados_editar();
            // verMaterias();
            $('#modal_editar_materias').modal('show');

            // verMaterias();
        });



    });

    //*****************************************************
    $('.guardando').click(function(e) {
            e.preventDefault();

            // Obtener la fila padre del enlace clicado
            var fila = $(this).closest('.fila-materia');
            // Obtener los datos de la fila
            var id = fila.find('td:eq(0)').text();
            var nombre = fila.find('td:eq(1)').text();
            if(existeAgregadoMateria(id)){
                alert('el curso ya esta agregado');
            }else{
                // Crear un objeto con los datos de la fila seleccionada
                var datosFila = {
                id: id,
                nombre: nombre,
                
                };
                // Agregar los datos al objeto de filas seleccionadas
                datosSeleccionados.push(datosFila);
    
                // Actualizar la tabla con los datos seleccionados
                actualizarTablaSeleccionados();
            }
    });

    $('.editando').click(function(e) {
            e.preventDefault();

            // Obtener la fila padre del enlace clicado
            var fila = $(this).closest('.fila-materia');
            // Obtener los datos de la fila
            var id = fila.find('td:eq(0)').text();
            var nombre = fila.find('td:eq(1)').text();
            if(existeAgregadoMateriaEditar(id)){
                alert('el curso ya esta agregado');
            }else{
                // Crear un objeto con los datos de la fila seleccionada
                var datosFila = {
                id: id,
                nombre: nombre,
                
                };
                // Agregar los datos al objeto de filas seleccionadas
                datosSeleccionados_editar.push(datosFila);
    
                // Actualizar la tabla con los datos seleccionados
                actualizarTablaSeleccionados_editar();
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
               
                '<td>' + datosSeleccionados[i].id + '</td>' +
                '<td>' + datosSeleccionados[i].nombre + '</td>' +
      
                '<td><button class="btn btn-danger btnEliminar" data-indice="' + i + '"><i class="fas fa-trash"></i></button></td>' +
                '</tr>';

            tablaSeleccionados.append(filaSeleccionada);
            }
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

        function actualizarTablaSeleccionados_editar() {
            var tablaSeleccionados2 = $('#tablaSeleccionados_editar tbody');
            tablaSeleccionados2.empty();

            // Iterar sobre los datos seleccionados y agregar filas a la tabla
            for (var i = 0; i < datosSeleccionados_editar.length; i++) {
            var filaSeleccionada2 =
                '<tr>' +
               
                '<td>' + datosSeleccionados_editar[i].id + '</td>' +
                '<td>' + datosSeleccionados_editar[i].nombre + '</td>' +
      
                '<td><button class="btn btn-danger btnEliminar" data-indice="' + i + '"><i class="fas fa-trash"></i></button></td>' +
                '</tr>';

            tablaSeleccionados2.append(filaSeleccionada2);
            }
        }

        function existeAgregadoMateria(materia){
            var resultado = false;
            for(let i=0; i<datosSeleccionados.length; i++){
                if(materia==datosSeleccionados[i].id){
                    resultado=true;
                }
            }
            return resultado;
        }
        function existeAgregadoMateriaEditar(materia){
            var resultado = false;
            for(let i=0; i<datosSeleccionados_editar.length; i++){
                if(materia==datosSeleccionados_editar[i].id){
                    resultado=true;
                }
            }
            return resultado;
        }

        function guardar(){
         
            var data = {
                materias:datosSeleccionados,
                id_gestion: id_gestion,
                id_curso: id_curso,
                _token: $('meta[name="csrf-token"]').attr('content'),
            };

            $.post('/materiagestion/guardar', data)
                .done(function (response) {
                    console.log('Respuesta exitosa:', response);
                    alert('agregado correctamente');
                    $('#modal_materias').modal('hide');
                    
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
             id_materia,
             id_curso,
             id_gestion,
             
         };
         datosSeleccionados_ver=[];
         datosSeleccionados_editar=[];
         $.get('/materiagestion/ver', data)
             .done(function (response) {
                 console.log('Respuesta exitosa:', response);
                 datosSeleccionados_ver = response;
                 datosSeleccionados_editar = response;
                 
                 console.log(datosSeleccionados_ver);
                 console.log(datosSeleccionados_editar);
                 actualizarTablaSeleccionados_ver();
                 actualizarTablaSeleccionados_editar();
                 //actualizarTablaSeleccionados_ver();
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

        function verCursosGestion(id_gestion){
         
         var data = {
             id_gestion,
         };
         selectSeleccionados=[];
         $.get('/materiagestion/cursosgestion', data)
             .done(function (response) {
                 console.log('Respuesta exitosa:', response);
                 selectSeleccionados = response;
               
                 
                 console.log(selectSeleccionados);
               
                 actualizarSelectCursosGestion();
        
                 //actualizarTablaSeleccionados_ver();
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

        function modificar(){
            data={
                materias:datosSeleccionados_editar,
                id_gestion,
                id_curso,
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            $.post('/materiagestion/modificar', data)
                .done(function (response) {
                    console.log('Respuesta exitosa:', response);
                    $('#modal_editar_materias').modal('hide');
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

        function actualizarSelectCursosGestion() {
            var select = $('#id_cursoxgestion');
            var choices = new Choices(select);


            var opciones = selectSeleccionados.map(function(opcion) {
            return { value: opcion.anio};
            });

            choices.setChoices(opciones, "value", "label");
           
           

        }
        
    
</script>
@endsection
