<template>
    <main>
        <div class="container-fluid px-4">
            <div class="card-header text-center p-2" style="border-bottom:1px solid black">
                <h1 class="mt-4" style="font-size:20px;">GESTION INSCRIPCIONES</h1>
            </div>

            <div class="row">
                <div class="table-container">
                    <div class="mb-3 mt-3">
                        <button @click="nuevaInscripcion()" id="nueva_inscripcion" class="btn btn-primary text-white"><i
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
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in itemsInscripciones" :key="item.id_inscripcion">
                                <td>{{  item.id_inscripcion}}</td>
                                <td>{{  item.ci_alumno}}</td>
                                <td>{{  item.nombre}}</td>
                                <td>{{  item.apellidos}}</td>
                                <td>{{  item.rude}}</td>
                                <td>{{  item.grado}}</td>
                                 <td>{{  item.turno}}</td>
                                <td>
                                    <template v-if="item.estado==0">
                                        <span class="badge bg-success" style="color:White;">Activo</span>
                                    </template>
                                    <template v-else-if="item.estado==1">
                                        <span class="badge bg-danger" style="color:White;">Inactivo</span>
                                    </template>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li v-if="item.estado==1"><a @click="activar(item)" class="dropdown-item" href="#">Activar</a></li>
                                            <li v-if="item.estado==0"><a @click="desactivar(item)" class="dropdown-item editando" href="#">Desactivar</a></li>
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
                                    
                                    <section class="dropdown-wrapper form-control bg-disabled">
                                        <div @click="isVisibleAlumno = !isVisibleAlumno" class="selected-item">
                                            <span v-if="datos_alumno.nombre_completo==''">Seleccione un alumno</span>
                                            <span  v-else>{{datos_alumno.nombre_completo }} </span>
                                            <svg :class="isVisibleAlumno ? 'dropdown' : ''" class="drop-down-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/></svg>
                                        </div>
                                        <div :class="isVisibleAlumno  ? 'visible' : 'invisible'" class="dropdown-popover" style="position: absolute; z-index: 9999;">
                                            <input type="text" class="form-control" placeholder="Buscar alumno.."  v-model="datos_alumno.buscador" aria-label="Buscar alumno..">
                                            <div class="text-center"><span v-if="filteredItemsAlumnos.length === 0">No existe el alumno</span></div>
                                            <div class="options">
                                                <ul>
                                                    <li @click="selectItem(alumno)" v-for="(alumno, index) in filteredItemsAlumnos" :key="index">{{alumno.nombre +' '+alumno.apellidos}}</li>
                                                </ul>
                                            </div>
                                        </div> 
                                    </section>
                                    
                                </div>
                                <div class="col-md-4">
                                    <label for="ci_alumno" class="form-label">CI:</label>
                                    <input v-model="datos_alumno.ci_alumno" type="text" class="form-control" id="ci_alumno" name="ci_alumno" placeholder="Ingrese el CI del alumno">
                                </div>

                                <div class="col-md-4">
                                    <label for="rude" class="form-label">Rude:</label>
                                    <input v-model="datos_alumno.rude" type="text" class="form-control" id="rude" name="rude"
                                        placeholder="Ingrese el RUDE del alumno">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nombre" class="form-label">Curso - Gestion:</label>
                                    
                                  

                                    <section class="dropdown-wrapper form-control bg-disabled">
                                        <div @click="isVisible = !isVisible" class="selected-item">
                                            <span v-if="curso_gestion.curso_gestion_select==''">Seleccione un curso_gestion</span>
                                            <span  v-else>{{curso_gestion.curso_gestion_select }} </span>
                                            <svg :class="isVisible ? 'dropdown' : ''" class="drop-down-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/></svg>
                                        </div>
                                        <div :class="isVisible  ? 'visible' : 'invisible'" class="dropdown-popover" style="position: absolute; z-index: 9999;">
                                            <input type="text" class="form-control" placeholder="Buscar curso.."  v-model="curso_gestion.curso_x_gestion" aria-label="Buscar curso..">
                                            <div class="text-center"><span v-if="filteredItemsCursoGestion.length === 0">No existe el curso</span></div>
                                            <div class="options">
                                                <ul>
                                                    <li @click="selectItemCursoGestion(cursogestion)" v-for="(cursogestion, index) in filteredItemsCursoGestion" :key="index">{{cursogestion.grado +' '+cursogestion.anio}}</li>
                                                </ul>
                                            </div>
                                        </div> 
                                    </section>
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
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in itemsMateriasCursogestiones" :key="item.id_materia">
                                                    <th>{{ item.id_materia }}</th>
                                                    <th>{{ item.nombre }}</th>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a @click="guardar()" id="btn_guardar" class="btn btn-primary">Guardar</a>
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

                itemsMateriasCursogestiones: [],
                datos_alumno:{
                    id_alumno:'',
                    nombre_completo:'',
                    rude:'',
                    ci_alumno:'',
                    buscador:'',
                },
                curso_gestion:{
                    curso_x_gestion:'',
                    id_gestion:'',
                    id_curso:'',
                    curso_gestion_select:'',
               
                },
                datos_inscripcion:{
                    id_gestion:0,
                    id_curso:0,
                    id_alumno:0,
                    id_inscripcion:0,
                },
                isVisible:false,
                isVisibleAlumno:false,
                showResults : false,
                showResultsCursoGestion : false
                
            };
        },
        computed:{
            filteredItemsAlumnos() {
            const searchTermLower = this.datos_alumno.buscador.toLowerCase();
            return this.itemsAlumnos.filter(item => item.nombre.toLowerCase().includes(searchTermLower));
            },
            filteredItemsCursoGestion() {
            const searchTermLower = this.curso_gestion.curso_x_gestion.toLowerCase();
            return this.itemsCursogestiones.filter(item => item.grado.toLowerCase().includes(searchTermLower));
            },
        },
        mounted() {
            console.log('Component mounted.');
          
            this.getInscripciones();
            this.getAlumnos();
            this.getCursogestiones();
            
            
        },

        methods: {
            nuevaInscripcion(){
                this.datos_alumno.id_alumno=0;
                this.datos_alumno.nombre_completo='';
                this.datos_alumno.ci_alumno='';
                this.datos_alumno.rude='';
            },
            toggleResults() {
                this.showResultsCursoGestion = !this.showResultsCursoGestion;
            },
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
            buscandoAlumno() {
                this.showResults = this.datos_alumno.nombre_completo !== '';
            },
            buscandoCursogestion() {
                this.showResultsCursoGestion = this.curso_gestion.curso_x_gestion !== '';
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
                      
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },

            getMateriasCursoGestion(id_curso, id_gestion){
                let url='/materiagestion/ver?id_curso='+id_curso+'&id_gestion='+id_gestion;
                let me=this;
                axios.get(url)
                .then(function(response){
                    console.log(response);
                    me.itemsMateriasCursogestiones=response.data;
                })
                .catch(function(error){
                    console.log(error)
                })
            },
            selectItem(item) {
                    this.datos_alumno.nombre_completo = item.nombre+' '+item.apellidos;
                    this.datos_alumno.id_alumno = item.id;
                    this.datos_alumno.ci_alumno = item.ci_alumno;
                    this.datos_alumno.rude = item.rude;
                    console.log(this.datos_alumno.nombre_completo, this.datos_alumno.id_alumno);
                    this.showResults = false;
                    this.isVisibleAlumno= false;
                    this.datos_inscripcion.id_alumno=this.datos_alumno.id_alumno;

            },
            
            selectItemCursoGestion(item) {
                    //this.curso_gestion.curso_x_gestion = item.grado +' '+item.anio;
                    this.curso_gestion.id_gestion = item.id_gestion;
                    this.curso_gestion.id_curso = item.id_curso;
                    this.curso_gestion.curso_gestion_select= item.grado +' '+item.anio;

                    console.log(this.curso_gestion.curso_x_gestion, this.curso_gestion.id_gestion, this.curso_gestion.id_curso);
                    this.showResultsCursoGestion = false;
                    this.isVisible= false;
                    this.getMateriasCursoGestion(this.curso_gestion.id_curso, this.curso_gestion.id_gestion);
                    this.datos_inscripcion.id_curso=this.curso_gestion.id_curso;
                    this.datos_inscripcion.id_gestion=this.curso_gestion.id_gestion;


            },

            async guardar(){
                let url = "/inscripcion/guardar";
                let me=this;
                await axios.post(url, me.datos_inscripcion)
                .then(function(response){
                    console.log(response);
                    $('#modal_guardar').modal('hide');
                    alert("guardado correctamente");
                    me.getInscripciones();
                })
                .catch(function (error){
                    console.log(error);
                })
            },

            async activar(inscripcion){
                let url = "/inscripcion/activar";
                let me=this;
                me.datos_inscripcion.id_inscripcion=inscripcion.id_inscripcion;
                await axios.post(url, me.datos_inscripcion)
                .then(function(response){
                    console.log(response);
                 
                    me.getInscripciones();
                    //alert("activado correctamente");
                })
                .catch(function (error){
                    console.log(error);
                })
            },

            async desactivar(inscripcion){
                let url = "/inscripcion/desactivar";
                let me=this;
                me.datos_inscripcion.id_inscripcion=inscripcion.id_inscripcion;
                await axios.post(url, me.datos_inscripcion)
                .then(function(response){
                    console.log(response);
             
                    me.getInscripciones();
                    //alert("desactivado correctamente");
                })
                .catch(function (error){
                    console.log(error);
                })
            }
        }
    }

</script>

<style>
.search-container {
  position: relative;
}

ul.list-group {
  position: absolute;
  z-index: 1;
  background-color: white;
  list-style-type: none;
  padding: 0;
  margin: 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  max-height: 200px;
  overflow-y: auto;
  width: 100%;
}

ul.list-group li {
  padding: 8px 12px;
  cursor: pointer;
}

ul.list-group li:hover {
  background-color: #f2f2f2;
}

span.toggle-results {
  display: block;
  text-align: center;
  margin-top: 8px;
  cursor: pointer;
}

.input-group-append {
  position: absolute;
  right: 0;
  top: 0;
  height: 100%;
}



.rotate-icon {
  transform: rotate(180deg);
}

.dropdown-wrapper {
  position: relative;
}

.dropdown-wrapper .selected-item {
  height: 25px;
  border-radius: 5px;
  padding: 5px 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.dropdown-wrapper .selected-item .drop-down-icon {
  transform: rotate(0deg);
  transition: all 0.5s ease;
}

.dropdown-wrapper .selected-item .drop-down-icon.dropdown {
  transform: rotate(180deg);
}

.dropdown-wrapper .dropdown-popover {
  position: absolute;
  border: 2px solid lightgray;
  top: 46;
  left: 0;
  right: 0;
  background-color: #fff;
  max-width: 100%;
  align-items: center;
  padding: 10px;
  visibility: hidden;
  transition: all 0.35s linear;
  max-height: 0px;
  overflow: hidden;
}

.dropdown-wrapper .dropdown-popover.visible {
  max-height: 450px;
  visibility: visible;
}

.dropdown-wrapper .dropdown-popover input {
  width: 100%;
  height: 30px;
  border: 2px solid lightgray;
  font-size: 18px;
  padding-left: 8px;
}

.dropdown-wrapper .dropdown-popover .options {
  width: 100%;
  padding-top: 12px;
}

.dropdown-wrapper .dropdown-popover .options ul {
  list-style: none;
  text-align: left;
  padding-left: 2px;
  max-height: 200px;
  overflow-y: scroll;
  overflow-x: hidden;
}

.dropdown-wrapper .dropdown-popover .options li {
  width: 100%;
  border-bottom: 1px solid lightgray;
  padding: 5px;
  border: 1px solid lightgray;
  background-color: #f1f1f1;
  cursor: pointer;
}

.dropdown-wrapper .dropdown-popover .options li:hover {
  background: #44536E;
  color: #fff;
  font-weight: bold;
}
</style>