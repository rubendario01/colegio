<template>
    <main>
        <div class="container-fluid px-4">
            <div class="card-header text-center p-2" style="border-bottom:1px solid black">
                <h1 class="mt-4" style="font-size:20px;">GESTION AULAS</h1>
            </div>

            <div class="row">
                <div class="table-container">
                    <div class="mb-3 mt-3">
                        <button @click="nuevoRegistro()" id="nuevo_registro" class="btn btn-primary text-white"><i
                                class="fas fa-plus text-white"></i>
                            Nuevo</button>
                    </div>
                    <table class="table">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Aula</th>
                                <th>Curso</th>
                                <th>Turno</th>
                                <th>Estado</th>
                                <th>Opciones</th>
            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                       
                                <td>
                                 
                                    <span class="badge bg-success" style="color:White;">Activo</span>
                                   
                                    <!-- <template>
                                        <span class="badge bg-danger" style="color:White;">Inactivo</span>
                                    </template> -->
                                </td>
                                <td class="text-center">
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
                            <h5 class="modal-title" id="exampleModalLabel">Registro de aula</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nombre" class="form-label">Seleccione una Gestión:</label>
                                    
                                  

                                    <section class="dropdown-wrapper form-control bg-disabled">
                                        <div @click="isVisibleGestion = !isVisibleGestion" class="selected-item">
                                            <span v-if="gestion.buscar==''">Seleccione una gestión</span>
                                            <span  v-else>{{gestion.buscar }} </span>
                                            <svg :class="isVisibleGestion ? 'dropdown' : ''" class="drop-down-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/></svg>
                                        </div>
                                        <div :class="isVisibleGestion  ? 'visible' : 'invisible'" class="dropdown-popover" style="position: absolute; z-index: 9999;">
                                            <input type="text" class="form-control" placeholder="Buscar curso.."  v-model="gestion.idd_gestion" aria-label="Buscar gestion..">
                                            <div class="text-center"><span v-if="filteredItemsGestion.length === 0">No existe la gestión</span></div>
                                            <div class="options">
                                                <ul>
                                                    <li @click="seleccionarGestion(gestion)" v-for="(gestion, index) in filteredItemsGestion" :key="index">{{gestion.anio}}</li>
                                                </ul>
                                            </div>
                                        </div> 
                                    </section>
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
    import axios from 'axios';
import Choices from 'choices.js';
    $(document).ready(function(){
        
    });
    export default {
        data() {
            return {
                isVisibleGestion:false,
                items_gestiones:[],
                gestion:{
                    idd_gestion:'',
                    anio:0,
                    buscar:'',
                }
                
            };
        },
        computed:{
            filteredItemsGestion() {
                const searchTermLower = this.gestion.idd_gestion.toLowerCase();
                return this.items_gestiones.filter(item => item.anio.toLowerCase().includes(searchTermLower));
            },
        },
        mounted() {
            console.log('Component mounted.');
        
        },

        methods: {
            nuevoRegistro(){
                $('#modal_guardar').modal('show');
                this.getGestiones();
            },

            getGestiones(){
                const url='/aula/gestiones';
                let me = this;
                axios.get(url).then(function(response){
                    console.log(response.data);
                    me.items_gestiones=response.data;
                })
                .catch(function(error){
                    console.log(error);p
                })
            },
            seleccionarGestion(item) {
                console.log(item);
                this.isVisibleGestion= false;
                this.gestion.buscar=item.anio;
            },
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