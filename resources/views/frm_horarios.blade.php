@extends('plantilla2')

@section('content')
<div class="container-fluid px-4">
    <div class="card-header text-center p-2" style="border-bottom:1px solid black">
        <h1 class="mt-4" style="font-size:20px;">GESTION HORARIOS</h1>
    </div>

    <div class="row">
        <div class="table-container">
            <div class="mb-3 mt-3">
                <button id="nuevo_horario" class="btn btn-primary text-white"><i class="fas fa-plus text-white"></i> Nuevo</button>
            </div>
            <table class="table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($horarios as $horario)
                  <tr class="fila-horario">
                        <td>{{$horario->id}}</td>
                        <td>{{$horario->dia}}</td>
                        <td>{{$horario->hora_inicio}}</td>
                        <td>{{$horario->hora_fin}}</td>
                        <td>
                            <a href="#" class="btn btn-info editando"><i class="fas fa-pencil-alt text-white"></i></a>
                            <form action="/horarios/eliminar" method="post" style="display:inline-block">
                                @csrf
                                <input type="hidden" name="id" value="{{$horario->id}}">
                                <button class="btn btn-danger"><i class="fas fa-trash text-white"></i></button>
                            </form>
                        </td>
                  </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal_guardar" class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form method="post" action="/horarios/guardar">
            @csrf
            <input type="hidden" id="id" name="id" value="">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Horario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <div class="mb-3">
                        <label for="dia" class="form-label">Día:</label>
                        <input type="text" class="form-control" id="dia" name="dia" placeholder="Ingrese el día">
                    </div>
                    <div class="mb-3">
                        <label for="hora_inicio" class="form-label">Hora Inicio:</label>
                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" placeholder="Ingrese la hora de inicio">
                    </div>
                    <div class="mb-3">
                        <label for="hora_fin" class="form-label">Hora Fin:</label>
                        <input type="time" class="form-control" id="hora_fin" name="hora_fin" placeholder="Ingrese la hora de fin">
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
        $('#nuevo_horario').on('click', function(){
            console.log('click');
            $("#dia").val('');
            $("#hora_inicio").val('');
            $("#hora_fin").val('');
            $("#id").val(0);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Guardar");
        })
    
        $('.editando').on('click', function(){
            // Obtener la fila padre del enlace de edición
            var fila = $(this).closest('.fila-horario');
    
            // Obtener los valores de cada columna de la fila
            var id = fila.find('td:eq(0)').text();
            var dia = fila.find('td:eq(1)').text();
            var horaInicio = fila.find('td:eq(2)').text();
            var horaFin = fila.find('td:eq(3)').text();
    
            console.log('click');
            $("#dia").val(dia);
            $("#hora_inicio").val(horaInicio);
            $("#hora_fin").val(horaFin);
            $("#id").val(id);
            $("#modal_guardar").modal("show");
            $("#btn_guardar").html("Modificar");
        })
    })
</script>
@endsection
