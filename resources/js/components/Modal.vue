<template>
  <div>
      <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;overflow-y: scroll;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal" ></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Ap. Paterno</label>
                                <div class="col-md-3">
                                    <input type="text" v-if="tipoAccion==1" v-model="per_paterno" class="form-control" disabled>
                                    <input type="text" v-if="tipoAccion==2" v-model="per_paterno" class="form-control" disabled>
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Ap. Materno</label>
                                <div class="col-md-3">
                                    <input type="text" v-if="tipoAccion==1" v-model="per_materno" class="form-control" disabled>
                                    <input type="text" v-if="tipoAccion==2" v-model="per_materno" class="form-control" disabled>
                                    
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Nombres</label>
                                <div class="col-md-3">
                                    <input type="text" v-if="tipoAccion==1" v-model="per_nombre" class="form-control" disabled>
                                    <input type="text" v-if="tipoAccion==2" v-model="per_nombre" class="form-control" disabled>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Nro. Documento</label>
                                <div class="col-md-2">
                                    <input type="text" v-if="tipoAccion==1" v-model="perdest_nro_doc" class="form-control">
                                    <input type="text" v-if="tipoAccion==2" v-model="perdest_nro_doc" class="form-control">
                                    <span class="help-block">(*) Requerido  </span>
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Documento</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-if="tipoAccion==1" v-model="perdest_tipo_doc">
                                        <option value="0" disabled>SELECCIONAR</option>
                                        <option value="ORDEN GENERAL DE DESTINOS">ORDEN GENERAL DE DESTINOS</option>
                                        <option value="MEMORANDUM">MEMORANDUM</option>
                                        <option value="FAX">FAX</option>
                                    </select>
                                    <select class="form-control" v-if="tipoAccion==2" v-model="perdest_tipo_doc">
                                        <option value="0" disabled>SELECCIONAR</option>
                                        <option value="ORDEN GENERAL DE DESTINOS">ORDEN GENERAL DE DESTINOS</option>
                                        <option value="MEMORANDUM">MEMORANDUM</option>
                                        <option value="FAX">FAX</option>
                                    </select>
                                    
                                    <span class="help-block">(*) Requerido   </span>
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Fecha Doc.</label>
                                <div class="col-md-3">
                                    <input type="date" v-if="tipoAccion==1" v-model="perdest_fechadestino" class="form-control">
                                    <input type="date" v-if="tipoAccion==2" v-model="perdest_fechadestino" class="form-control">
                                    <span class="help-block">(*) Requerido   </span>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Organismo</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="perdest_destn1_codigo" v-on:change="changeItem1(rowId, $event)">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="destinos_nivel1 in arrayDestinos_nivel1" :key="destinos_nivel1.id" :value="destinos_nivel1.id"  v-text="destinos_nivel1.destn1_descripcion"></option>
                                    
                                    </select>
                                    <span class="help-block">(*) Seleccione   </span>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Gran Unidad</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="perdest_destn2_codigo" v-on:change="changeItem2(rowId, $event)">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="destinos_nivel2 in arrayDestinos_nivel2" :key="destinos_nivel2.id" :value="destinos_nivel2.id"  v-text="destinos_nivel2.destn2_descripcion"></option>
                                    
                                    </select>
                                    <span class="help-block">(*) Seleccione  </span>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Repartición</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="perdest_destn3_codigo" v-on:change="changeItem3(rowId, $event)">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="destinos_nivel3 in arrayDestinos_nivel3" :key="destinos_nivel3.id" :value="destinos_nivel3.id"  v-text="destinos_nivel3.destn3_descripcion"></option>
                                    
                                    </select>
                                    <span class="help-block">(*) Seleccione  </span>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Sub Repatición</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="perdest_destn4_codigo">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="destinos_nivel4 in arrayDestinos_nivel4" :key="destinos_nivel4.id" :value="destinos_nivel4.id"  v-text="destinos_nivel4.destn4_descripcion"></option>
                                    
                                    </select>
                                    <span class="help-block">(*) Seleccione </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Primer Cargo</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="perdest_cargo1">
                                        <option value="0" disabled>SELECCIONE</option>
                                        <option v-for="cargos in arrayCargos" :key="cargos.id" :value="cargos.id" v-text="cargos.desc_cargo"></option>
                                    </select>
                                    <span class="help-block">(*) Seleccione  </span>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Segundo Cargo</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="perdest_cargo2">
                                        <option value="0" disabled>SELECCIONE</option>
                                        <option v-for="cargos in arrayCargos" :key="cargos.id" :value="cargos.id" v-text="cargos.desc_cargo"></option>
                                    </select>                                    
                                    <!--<span class="help-block">(*) Ingrese el apellido  </span>-->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Observaciones</label>
                                <div class="col-md-10">
                                    <input type="text" v-if="tipoAccion==1" v-model="perdest_observaciones" class="form-control">
                                    <input type="text" v-if="tipoAccion==2" v-model="perdest_observaciones" class="form-control">
                                </div>
                            </div>

                            <div v-show="errorPersonal_destinos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPersonal_destinos" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersonal_destinos()">Guardar</button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersonal_destinos()">Actualizar</button>
                                <!--<button type="button" v-if="tipoAccion==2" class="btn btn-secundary" @click="abrirModal('destino','registrar',personal)">Ir Registro</button>-->
                            </div>
                    <nav>
                        <!-- inicio para paginacion -->
                        <!--<ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina_dest(pagination.current_page - 1,buscar_dest)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina_dest(page,buscar_dest)" v-text="page"></a>
                            </li>
                           
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina_dest(pagination.current_page + 1,buscar_dest)">Sig</a>
                            </li>
                        </ul>-->
                        <!-- fin paginacion -->
                    </nav>

                            <!--<div v-show="errorPersonal_destinos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPersonal_destinos" :key="error" v-text="error">
                                    </div>
                                </div>
                            
                            </div>-->
                        </form>
                    </div>
                    <!--<div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersonal_destinos()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersonal_destinos()">Actualizar</button>
                    </div>-->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>