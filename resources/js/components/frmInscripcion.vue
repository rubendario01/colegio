<template>
    <main>
        <div class="container-fluid px-4">
            <div class="card-header text-center p-2" style="border-bottom:1px solid black">
                <h1 class="mt-4" style="font-size:20px;">GESTION INSCRIPCIONES</h1>
            </div>

            <div class="row">
                <div class="table-container">
                    <div class="mb-3 mt-3">
                        <button id="nueva_inscripcion" class="btn btn-primary text-white"><i
                                class="fas fa-plus text-white"></i>
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
                            <tr v-for="item in itemsInscripciones" :key="item.id_inscripcion">
                                <td>
                                    <option>{{  item.id_inscripcion}}</option>
                                </td>
                                <td>
                                    <option>{{  item.ci_alumno}}</option>
                                </td>
                                <td>
                                    <option>{{  item.nombre}}</option>
                                </td>
                                <td>
                                    <option>{{  item.apellidos}}</option>
                                </td>
                                <td>
                                    <option>{{  item.rude}}</option>
                                </td>
                                <td>
                                    <option>{{  item.grado}}</option>
                                </td>
                                <td>
                                    <option>{{  item.turno}}</option>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="#">Activar</a></li>
                                            <li><a class="dropdown-item editando" href="#">Desactivar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="modal_guardar" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                    <select id="id_alumno" v-model="datos.id_alumno" class="form-control choices-single"
                                        style="font-size:2 rem !important">
                                        <option v-bind:value="item.id"
                                            v-for="item in itemsAlumnos" :key="item.id">
                                            {{ item.descripcion }}
                                        </option>
                                
                                    </select>
                                    <input type="text" v-model="datos.id_alumno" class="form-control" placeholder="Buscar..." @input="handleInput()">
                                    <div v-if="showResults" class="position-absolute bg-white border rounded p-2 shadow" style="top: 100%; left: 0; right: 0; z-index: 100">
                                        <ul class="list-group">
                                            <li v-for="item in filteredItems" :key="item.id" class="list-group-item" @click="selectItem(item)">{{ item.nombre }}</li>
                                        </ul>
                                    </div>
                                    
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
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <label for="nombre" class="form-label">Curso gestion:</label>
                                    <select id="id_cursogestion" class="form-control choices-single"
                                        style="font-size:2 rem !important" v-for = "item in itemsCursogestiones" :key="item.id_curso">

                       
                                        <option> {{ item.anio + ' '+ item.grado}}</option>
                           
                                    </select>
                                </div>
                            </div> -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="table-container">
                                        <p class="fs-5">Materias que tiene el curso:</p>

                                        <table id="tablaSeleccionados_ver" class="table table-striped table-hover">
                                            <thead class="bg-secondary text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                 
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
    </main>

</template>

<script>
    import Choices from 'choices.js';
    $(document).ready(function(){
        $(document).on('click', '#nueva_inscripcion', function(){
            $('#modal_guardar').modal('show');
            
        });
    });
    export default {
        data() {
            return {
                itemsInscripciones: [],
                itemsAlumnos: [],
                itemsCursogestiones: [],
                datos:{
                    id_alumno:'',
                },
                showResults : false
                
            };
        },
        computed:{
            filteredItems() {
            const searchTermLower = this.datos.id_alumno.toLowerCase();
            return this.itemsAlumnos.filter(item => item.nombre.toLowerCase().includes(searchTermLower));
            },
        },
        mounted() {
            console.log('Component mounted.');
          
            this.getInscripciones();
            this.getAlumnos();
            this.getCursogestiones();
            
            
        },

        methods: {
            getInscripciones() {
                let url = '/get_inscripciones';
                let me = this;
                axios.get(url).then(function (response) {
                        me.itemsInscripciones = response.data;
                        
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            handleInput() {
                this.showResults = this.searchTerm !== '';
            },
            getAlumnos(){
                let url = '/get_alumnos';
                let me = this;
                axios.get(url).then(function (response) {
                        me.itemsAlumnos = response.data;
                        console.log(response);
                        //new Choices(document.querySelector("#id_alumno"));

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },

            getCursogestiones(){
                let url = '/get_cursogestiones';
                let me = this;
                axios.get(url).then(function (response) {
                        me.itemsCursogestiones = response.data;
                        //new Choices(document.querySelector("#id_cursogestion"));
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            selectItem(item) {
                this.datos.id_alumno = item.nombre;
                this.showResults = false;
                },
            }
    }

</script>
