<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              SIPEFAB
              <small>2.0.0</small>

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-globe-americas"></i>
                  <strong>DESTINOS</strong>
                </h3>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                        <div>
                            <label class="col-md-12 form-control-label">
                                <template v-if="arrayDatosPersonal.per_sexo=='MASCULINO'">
                                        DEL SEÑOR: {{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}
                                </template>
                                <template v-else>
                                        DE LA SEÑORA: {{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}
                                </template>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-primary btn-sm" @click="NuevoDestino()">
                            <i class="far fa-file-alt" aria-hidden="true">  REGISTRAR</i>
                        </button> &nbsp;
                        <button type="button" class="btn btn-primary btn-sm" @click="generarReporte(per_codigo)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button> &nbsp;
                    </div>
                    <table class="table table-bordered table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th><center>OPCIONES</center></th>
                                <th><center>REPARTICIÓN</center></th>
                                <th><center>SUB REPARTICIÓN</center></th>
                                <th><center>PRIMER CARGO</center></th>
                                <th><center>SEGUNDO CARGO</center></th>
                                <th><center>FECHA DESTINO</center></th>
                                <th><center>DESTINO</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="personalDestinos in arrayPersonalDestinos" :key="personalDestinos.id">
                                
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirEditar(personalDestinos,arrayPersonalDestinos2)">
                                        <i class="fas fa-edit"></i>
                                    </button> &nbsp;
                                    <template v-if="personalDestinos.perdest_flag==1">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarDestino(personalDestinos)" >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    </template>
                                    <!--<template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)">
                                        <i class="far fa-check-square"></i>
                                    </button>
                                    </template>-->
                                </td>
                                <td v-text="personalDestinos.destn3_descripcion" ></td>
                                <td v-text="personalDestinos.destn4_descripcion"></td> 
                                <td v-text="personalDestinos.cargo"></td> 
                                <td>{{ arrayPersonalDestinos2.find(function(el) { return el.idpersonal_destinos == personalDestinos.idpersonal_destinos; } ).cargo2 }}</td>
                                <!--<td v-for="personalDestinos2 in arrayPersonalDestinos2">--> 
                                    <!--<template v-for="personalDestinos2 in arrayPersonalDestinos2">
                                        <span v-if="personalDestinos2.idpersonal_destinos == personalDestinos.idpersonal_destinos">
                                        <td>{{personalDestinos2.cargo2}}</td>
                                        </span>
                                    </template> -->    
                                               
                                <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                <td >{{personalDestinos.perdest_fechadestino | moment("D/MM/YYYY")}}</td>
                                
                                <td>
                                <div v-if="personalDestinos.perdest_estado == 1">
                                    <span class="badge badge-success">ACTUAL</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">ANTERIOR</span>
                                </div>
                                </td>                            
                            </tr>
                            
                        </tbody>
                    </table>
                    <nav>
                        <!-- inicio para paginacion -->
                       <!--<ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                           
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>-->
                        <!-- fin paginacion -->
                    </nav>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->


        <!--MODAL CLASES
        id="NombreModal" -->
        <div class="modal fade" id="NuevoDestino">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR DESTINO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        
                        <div class="col-md-4">
                            <label class="form-control-label" for="text-input">NRO. DOCUMENTO</label>
                            <input type="text" v-model="perdest_nro_doc" class="form-control" :class="{ 'is-invalid' : $v.perdest_nro_doc.$error, 'is-valid':!$v.perdest_nro_doc.$invalid }">
                            <!--<span class="help-block">(*) Requerido</span>-->
                            <div class="invalid-feedback">
                                <span v-if="!$v.perdest_nro_doc.required">Este campo es Requerido</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label" for="text-input">TIPO DE DOCUMENTO</label>
                            <select class="form-control" v-model="perdest_tipo_doc" :class="{ 'is-invalid' : $v.perdest_tipo_doc.$error, 'is-valid':!$v.perdest_tipo_doc.$invalid }">
                                <option value="0" disabled>SELECCIONAR</option>
                                <option value="ORDEN GENERAL DE DESTINOS">ORDEN GENERAL DE DESTINOS</option>
                                <option value="MEMORANDUM">MEMORANDUM</option>
                                <option value="FAX">FAX</option>
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.perdest_tipo_doc.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-control-label" for="text-input">FECHA DEL DOCUMENTO</label>
                            <input type="date" v-model="perdest_fechadestino" class="form-control" :class="{ 'is-invalid' : $v.perdest_fechadestino.$error, 'is-valid':!$v.perdest_fechadestino.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.perdest_fechadestino.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">ORGANISMO</label>
                            <select class="form-control" v-model="perdest_destn1_codigo" v-on:change="changeItem1(rowId, $event)" :class="{ 'is-invalid' : $v.perdest_destn1_codigo.$error, 'is-valid':!$v.perdest_destn1_codigo.$invalid }">
                                <option value="" disabled>SELECCIONE</option>
                                <option v-for="destinos_nivel1 in arrayDestinos_nivel1" :key="destinos_nivel1.id" :value="destinos_nivel1.id"  v-text="destinos_nivel1.destn1_descripcion"></option>
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.perdest_destn1_codigo.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">GRAN UNIDAD</label>
                            <select class="form-control" v-model="perdest_destn2_codigo" v-on:change="changeItem2(rowId, $event)" :class="{ 'is-invalid' : $v.perdest_destn2_codigo.$error, 'is-valid':!$v.perdest_destn2_codigo.$invalid }">
                                <option value="" disabled>SELECCIONE</option>
                                <option v-for="destinos_nivel2 in arrayDestinos_nivel2" :key="destinos_nivel2.id" :value="destinos_nivel2.id"  v-text="destinos_nivel2.destn2_descripcion"></option>                        
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.perdest_destn2_codigo.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">REPARTICION</label>
                            <select class="form-control" v-model="perdest_destn3_codigo" v-on:change="changeItem3(rowId, $event)" :class="{ 'is-invalid' : $v.perdest_destn3_codigo.$error, 'is-valid':!$v.perdest_destn3_codigo.$invalid }">
                                <option value="" disabled>SELECCIONE</option>
                                <option v-for="destinos_nivel3 in arrayDestinos_nivel3" :key="destinos_nivel3.id" :value="destinos_nivel3.id"  v-text="destinos_nivel3.destn3_descripcion"></option>
                            
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.perdest_destn3_codigo.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">SUB-REPARTICION</label>
                            <select class="form-control" v-model="perdest_destn4_codigo" :class="{ 'is-invalid' : $v.perdest_destn4_codigo.$error, 'is-valid':!$v.perdest_destn4_codigo.$invalid }">
                                <option value="" disabled>SELECCIONE</option>
                                <option v-for="destinos_nivel4 in arrayDestinos_nivel4" :key="destinos_nivel4.id" :value="destinos_nivel4.id"  v-text="destinos_nivel4.destn4_descripcion"></option>
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.perdest_destn4_codigo.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">PRIMER CARGO</label>
                            <v-select
                                label="descripcion"
                                :options="arrayCargos"                      
                                v-model="valor" :class="{ 'is-invalid' : $v.valor.$error, 'is-valid':!$v.valor.$invalid }">                     
                                <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Lo sentimos, no hay opciones de coincidencia "<em>{{
                                    search
                                    }}"</em>.
                                </template>
                                <em v-else
                                    >Lo sentimos, no hay opciones de coincidencia.</em>
                                </template>
                            </v-select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.valor.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">SEGUNDO CARGO</label>
                            <v-select
                                label="descripcion"
                                :options="arrayCargos"                      
                                v-model="valor2" >                     
                                <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Lo sentimos, no hay opciones de coincidencia "<em>{{
                                    search
                                    }}"</em>.
                                </template>
                                <em v-else
                                    >Lo sentimos, no hay opciones de coincidencia.</em>
                                </template>
                            </v-select>                                   
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">OBSERVACIONES</label>
                            <textarea name="textarea" cols="100" rows="3" v-model="perdest_observaciones"></textarea>
                            <!--<input type="text" v-model="perdest_observaciones" class="form-control">-->
                        </div>
                    </div>

                    <!--<div v-show="errorPersonal_destinos" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errorMostrarMsjPersonal_destinos" :key="error" v-text="error">
                            </div>
                        </div>
                    </div>-->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="RegistrarDestino()">REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="EditarDestino">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR DESTINO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">NRO. DOCUMENTO</label>
                        <input type="text" v-model="perdest_nro_docA" class="form-control">
                        
                    </div>
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">TIPO DE DOCUMENTO</label>
                        <select class="form-control" v-model="perdest_tipo_docA">
                            <option value="0" disabled>SELECCIONAR</option>
                            <option value="ORDEN GENERAL DE DESTINOS">ORDEN GENERAL DE DESTINOS</option>
                            <option value="MEMORANDUM">MEMORANDUM</option>
                            <option value="FAX">FAX</option>
                        </select>
                        
                    </div>
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">FECHA DEL DOCUMENTO</label>
                        <input type="date" v-model="perdest_fechadestinoA" class="form-control">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">ORGANISMO</label>
                        <select class="form-control" v-model="perdest_destn1_codigoA" v-on:change="changeItem1(rowId, $event)" >
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="destinos_nivel1 in arrayDestinos_nivel1" :key="destinos_nivel1.id" :value="destinos_nivel1.id"  v-text="destinos_nivel1.destn1_descripcion"></option>
                        </select>
                        
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">GRAN UNIDAD</label>
                        <select class="form-control" v-model="perdest_destn2_codigoA" v-on:change="changeItem2(rowId, $event)" >
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="destinos_nivel2 in arrayDestinos_nivel2" :key="destinos_nivel2.id" :value="destinos_nivel2.id"  v-text="destinos_nivel2.destn2_descripcion"></option>                        
                        </select>
                        
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="col-md-2 form-control-label" for="text-input">REPARTICION</label>
                        <select class="form-control" v-model="perdest_destn3_codigoA" v-on:change="changeItem3(rowId, $event)" >
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="destinos_nivel3 in arrayDestinos_nivel3" :key="destinos_nivel3.id" :value="destinos_nivel3.id"  v-text="destinos_nivel3.destn3_descripcion"></option>
                        </select>
                        
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">SUB-REPARTICION</label>
                        <select class="form-control" v-model="perdest_destn4_codigoA" >
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="destinos_nivel4 in arrayDestinos_nivel4" :key="destinos_nivel4.id" :value="destinos_nivel4.id"  v-text="destinos_nivel4.destn4_descripcion"></option>
                        
                        </select>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">PRIMER CARGO</label>
                        <!--<v-select
                            label="descripcion"
                            :options="arrayCargos"                      
                            v-model="valorA" >                     
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia "<em>{{
                                search
                                }}"</em>.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em>
                            </template>
                        </v-select>-->
                            <select class="form-control" v-model="perdest_cargo1A" >
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="cargos in arrayCargos" :key="cargos.id" :value="cargos.id"  v-text="cargos.descripcion"></option>
                            </select>
                        
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">SEGUNDO CARGO</label>
                        <!--<v-select
                            label="descripcion"
                            :options="arrayCargos"                      
                            v-model="valorA2" >                     
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia "<em>{{
                                search
                                }}"</em>.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em>
                            </template>
                        </v-select>-->
                        <select class="form-control" v-model="perdest_cargo2A">
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="cargos in arrayCargos" :key="cargos.id" :value="cargos.id"  v-text="cargos.descripcion"></option>
                        </select>                                 
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">OBSERVACIONES</label>
                        <textarea name="textarea" cols="100" rows="3" v-model="perdest_observacionesA"></textarea>
                        <!--<input type="text" v-model="perdest_observacionesA" class="form-control">-->
                    </div>
                </div>

                    <!--<div v-show="errorPersonal_destinos" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errorMostrarMsjPersonal_destinos" :key="error" v-text="error">
                            </div>
                        </div>
                    </div>-->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="EditarDestino()">ACTUALIZAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
//import { required, minLength, between } from 'vuelidate/lib/validators'
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.d,
            arrayPersonalDestinos : [],
            arrayPersonalDestinos2 : [],
            arrayDatosPersonal : [],

            ano_actual : '',
            per_cmi : '',
            per_cmil : '',
            //VARIABLES MODAL
            rowId : 0,
            modal : 0,
            tituloModal : '',
            tipoAccion : 0,
            per_paterno : '',
            per_materno : '',
            per_nombre : '',
            per_cm : '',
            //VARIABLES REGISTRAR DESTINO
            perdest_nro_doc : '',
            perdest_tipo_doc : '',
            perdest_fechadestino : '',
            perdest_destn1_codigo : '',
            perdest_destn2_codigo : '',
            perdest_destn3_codigo : '',
            perdest_destn4_codigo : '',
            perdest_promo : 0,
            perdest_cargo1 : 0,
            perdest_cargo2 : 0,
            perdest_observaciones : '',
            //VARIABLES EDITAR DESTINO
            idPersonalDestino : 0,
            perdest_nro_docA : '',
            perdest_tipo_docA : '',
            perdest_fechadestinoA : '',
            perdest_destn1_codigoA : 0,
            perdest_destn2_codigoA : 0,
            perdest_destn3_codigoA : 0,
            perdest_destn4_codigoA : 0,
            promocionA : 0,
            perdest_promoA : 0,
            perdest_cargo1A : 0,
            perdest_cargo2A : 0,
            perdest_observacionesA : '',
            //ARRAYS
            arrayDestinos_nivel1 : [],
            arrayDestinos_nivel2 : [],
            arrayDestinos_nivel3 : [],
            arrayDestinos_nivel4 : [],
            //VARIABLES SELECT
            arrayCargos : [],
            valor : [],
            valor2 : [],
            valorA : [],
            valorA2 : [],
            //FIN VARIABLES SELCT
            //arrayCargos2 : [],

        }
    },

    validations:{/*
        nombre_den :{   required,
                        minLength: minLength(3),
                        maxLength: maxLength(14),
                        alpha
                    },
        ap_paterno_den :{   required,
                        minLength: minLength(3),
                        maxLength: maxLength(14),
                        alpha
                    },
        c_identidad_den :{   required,
                        minLength: minLength(5),
                        maxLength: maxLength(9),
                        numeric
                    },
        extencion_den : { required },
        telefono_celular :{   required,
                        minLength: minLength(8),
                        maxLength: maxLength(8),
                        numeric
                    },

        estado_civil : { required },
        fecha_nacimiento : { required },
        id_lugar_trabajo : { required },*/
      
        perdest_nro_doc : { required },
        perdest_tipo_doc : { required },
        perdest_fechadestino : { required },
        perdest_destn1_codigo : { required },
        perdest_destn2_codigo : { required },
        perdest_destn3_codigo : { required },
        perdest_destn4_codigo : { required },
        valor : { required },

        /*perdest_nro_docA : { required },
        perdest_tipo_docA : { required },
        perdest_fechadestinoA : { required },
        perdest_destn1_codigoA : { required },
        perdest_destn2_codigoA : { required },
        perdest_destn3_codigoA : { required },
        perdest_destn4_codigoA : { required },
        perdest_cargo1A : { required },*/
    },
    mounted() {
        //this.ver();
        this.listarPersonalDestinos(this.per_codigo);
        this.datosPersonal(this.per_codigo);
    },
    methods: {
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },

        listarPersonalDestinos(per_codigo){
            let me = this;
            axios
          .post("/listarPersonalDestinos", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            console.log(response)
           me.arrayPersonalDestinos = response.data.cargo1.data
           me.arrayPersonalDestinos2 = response.data.cargo2.data
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        datosPersonal(per_codigo){
            let me = this;
            axios
          .post("/datosPersonal", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            console.log(response)
            me.arrayDatosPersonal = response.data
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        changeItem1: function changeItem1(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel2(event.target.value);
        },
        changeItem2: function changeItem2(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel3(event.target.value);
        },
        changeItem3: function changeItem3(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel4(event.target.value);
        },
        selectDestinos_nivel1(){
            let me =this;
            var url='/destinos_nivel1/selectDestinos_nivel1';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel1 = respuesta.destinos_nivel1; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel2(){
            let me =this;
            var url='/destinos_nivel2/selectDestinos_nivel2';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel2 = respuesta.destinos_nivel2; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel3(){
            let me =this;
            var url='/destinos_nivel3/selectDestinos_nivel3';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel3 = respuesta.destinos_nivel3; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel4(){
            let me =this;
            var url='/destinos_nivel4/selectDestinos_nivel4';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel4 = respuesta.destinos_nivel1; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },
            
        selectbuscarDestinos_nivel2(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestinos_nivel2=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel2/selectbuscarDestinos_nivel2?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel2 = respuesta.destinos_nivel2; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        selectbuscarDestinos_nivel3(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestinos_nivel3=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel3/selectbuscarDestinos_nivel3?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel3 = respuesta.destinos_nivel3; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        selectbuscarDestinos_nivel4(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestinos_nivel4=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel4/selectbuscarDestinos_nivel4?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel4 = respuesta.destinos_nivel4; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        listarCargos(){
            let me = this;
            axios
            .get('/listarCargos')
            .then(function (response) {
        //Respuesta de la peticion
            console.log(response);
            
            me.arrayCargos = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });
        },

       obtenerPromocion(){
           this.per_cm = this.arrayDatosPersonal.per_cm;
                //obtiene la gestion actual
            var fecha = new Date();
            var ano = fecha.getFullYear();
            //obtiene variable.toString a varchar
            var ano1 = ano.toString()
            //para extraer
            var ano2 = ano1.substring(2,4);
            this.ano_actual = parseInt(ano2);
            
            //var per_cm1 = this.per_cm;
            //this.per_cmil = this.per_cm.substring(3,5);

            this.per_cmi = this.per_cm.substring(3,5);
            this.per_cmil = parseInt(this.per_cmi);

            if (this.per_cmil >= 0 && this.per_cmil <= this.ano_actual){
                this.perdest_promo = 2000 + this.per_cmil;
            }
            else{
                this.perdest_promo = 1900 + this.per_cmil;
            }
        },

        NuevoDestino(){
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            this.idPersonalDestino = 0,
            this.perdest_nro_doc = '',
            this.perdest_tipo_doc = '',
            this.perdest_fechadestino = '',
            this.perdest_destn1_codigo = '',
            this.perdest_destn2_codigo = '',
            this.perdest_destn3_codigo = '',
            this.perdest_destn4_codigo = '',
            this.perdest_cargo1 = '',
            this.perdest_cargo2 = ''
            this.perdest_observacionesA = '',
            //FIN PONER A CERO MODAL
            $('#NuevoDestino').modal('show');
            this.obtenerPromocion()
            this.selectDestinos_nivel1()
            this.selectDestinos_nivel2()
            this.selectDestinos_nivel3()
            this.selectDestinos_nivel4()
            this.selectbuscarDestinos_nivel2(this.perdest_destn1_codigo)
            this.selectbuscarDestinos_nivel3(this.perdest_destn2_codigo)
            this.selectbuscarDestinos_nivel4(this.perdest_destn3_codigo)
            this.listarCargos()
        },

        /*RegistrarDestino(){
            let me = this;
            axios
          .post("/registrarDestino", {
         //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
            perdest_codigocambio : me.per_codigo,
            perdest_nro_doc : me.perdest_nro_doc,
            perdest_tipo_doc : me.perdest_tipo_doc,
            perdest_fechadestino : me.perdest_fechadestino,
            perdest_destn1_codigo : me.perdest_destn1_codigo,
            perdest_destn2_codigo : me.perdest_destn2_codigo,
            perdest_destn3_codigo : me.perdest_destn3_codigo,
            perdest_destn4_codigo : me.perdest_destn4_codigo,
            perdest_cargo1 : me.valor.id,
            perdest_cargo2 : me.valor2.id,
            promocion : me.perdest_promo,
            perdest_observaciones : me.perdest_observaciones,
          })
          .then(function (response) {
            //Respuesta de la peticion
            console.log(response);
             $('#NuevoDestino').modal('hide');
             me.listarPersonalDestinos(me.per_codigo);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },*/

        RegistrarDestino(){
            if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de registrar este destino', // TITULO 
                    icon: 'question', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#868077', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .post("/registrarDestino", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            perdest_codigocambio : me.per_codigo,
                            perdest_nro_doc : me.perdest_nro_doc,
                            perdest_tipo_doc : me.perdest_tipo_doc,
                            perdest_fechadestino : me.perdest_fechadestino,
                            perdest_destn1_codigo : me.perdest_destn1_codigo,
                            perdest_destn2_codigo : me.perdest_destn2_codigo,
                            perdest_destn3_codigo : me.perdest_destn3_codigo,
                            perdest_destn4_codigo : me.perdest_destn4_codigo,
                            perdest_cargo1 : me.valor.id,
                            perdest_cargo2 : me.valor2.id,
                            promocion : me.perdest_promo,
                            perdest_observaciones : me.perdest_observaciones,
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            console.log(response);
                            $('#NuevoDestino').modal('hide');
                            me.listarPersonalDestinos(me.per_codigo);
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
                    }
                })  
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        },

        abrirEditar(personalDestinos,arrayPersonalDestinos2){
            let me =this;
            this.idPersonalDestino = personalDestinos.idpersonal_destinos,
            this.perdest_nro_docA = personalDestinos.perdest_nro_doc,
            this.perdest_tipo_docA = personalDestinos.perdest_tipo_doc,
            this.perdest_fechadestinoA = personalDestinos.perdest_fechadestino,
            this.perdest_fechadestinoA = this.perdest_fechadestinoA.substring(0,10);
                                        var info10 = this.perdest_fechadestinoA.split('-');
                                        this.perdest_fechadestinoA = info10[0] + '-' + info10[1] + '-' + info10[2];
            this.perdest_destn1_codigoA = personalDestinos.perdest_destn1_codigo,
            this.perdest_destn2_codigoA = personalDestinos.perdest_destn2_codigo,
            this.perdest_destn3_codigoA = personalDestinos.perdest_destn3_codigo,
            this.perdest_destn4_codigoA = personalDestinos.perdest_destn4_codigo,
            this.perdest_cargo1A = personalDestinos.idcargo,
            this.perdest_cargo2A = me.arrayPersonalDestinos2.find(function(el) { 
                return el.idpersonal_destinos == personalDestinos.idpersonal_destinos; 
                } ).idcargo2,
            this.perdest_promoA = this.perdest_promo,
            this.perdest_observacionesA = personalDestinos.perdest_observaciones,
            $('#EditarDestino').modal('show');
            this.obtenerPromocion()
            this.selectDestinos_nivel1()
            this.selectDestinos_nivel2()
            this.selectDestinos_nivel3()
            this.selectDestinos_nivel4()
            this.selectbuscarDestinos_nivel2(this.perdest_destn1_codigoA)
            this.selectbuscarDestinos_nivel3(this.perdest_destn2_codigoA)
            this.selectbuscarDestinos_nivel4(this.perdest_destn3_codigoA)
            this.listarCargos()
        },

        /*EditarDestino(){
            let me = this;
            axios
          .put("/editarDestino", {
        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
            idPersonalDestino : me.idPersonalDestino,
            perdest_codigocambio : me.per_codigo,
            perdest_nro_doc : me.perdest_nro_docA,
            perdest_tipo_doc : me.perdest_tipo_docA,
            perdest_fechadestino : me.perdest_fechadestinoA,
            perdest_destn1_codigo : me.perdest_destn1_codigoA,
            perdest_destn2_codigo : me.perdest_destn2_codigoA,
            perdest_destn3_codigo : me.perdest_destn3_codigoA,
            perdest_destn4_codigo : me.perdest_destn4_codigoA,
            perdest_cargo1 : me.perdest_cargo1A,
            perdest_cargo2 : me.perdest_cargo2A,
            promocion : me.perdest_promo,
            perdest_observaciones : me.perdest_observacionesA,
          })
          .then(function (response) {
            //Respuesta de la peticion
            console.log(response);
             $('#EditarDestino').modal('hide');
             me.listarPersonalDestinos(me.per_codigo);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },*/

        EditarDestino(){
            //if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de modificar este destino', // TITULO 
                    icon: 'question', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#868077', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .put("/editarDestino", {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        idPersonalDestino : me.idPersonalDestino,
                        perdest_codigocambio : me.per_codigo,
                        perdest_nro_doc : me.perdest_nro_docA,
                        perdest_tipo_doc : me.perdest_tipo_docA,
                        perdest_fechadestino : me.perdest_fechadestinoA,
                        perdest_destn1_codigo : me.perdest_destn1_codigoA,
                        perdest_destn2_codigo : me.perdest_destn2_codigoA,
                        perdest_destn3_codigo : me.perdest_destn3_codigoA,
                        perdest_destn4_codigo : me.perdest_destn4_codigoA,
                        perdest_cargo1 : me.perdest_cargo1A,
                        perdest_cargo2 : me.perdest_cargo2A,
                        promocion : me.perdest_promo,
                        perdest_observaciones : me.perdest_observacionesA,
                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        console.log(response);
                        $('#EditarDestino').modal('hide');
                        me.listarPersonalDestinos(me.per_codigo);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
                    }
                })  
            /*}else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
            }*/
        },

        /*desactivarDestino(personalDestinos){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Esta usted seguro de desactivar este destino?',
            
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
                
            if (result.value) {
                
            let me =this;
            this.idPersonalDestino = personalDestinos.idpersonal_destinos,
            axios
            .put('/desactivarDestino',{
                idPersonalDestino : me.idPersonalDestino,
                per_codigo : me.per_codigo,
            }).then(function (response) {
                console.log(response);
                me.listarPersonalDestinos(me.per_codigo);
                swalWithBootstrapButtons.fire(
                'Desactivado!',
                'El destino ha sido desactivado.',
                'Satisfactoriamente'
                )

            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });

            } else if (
                // Read more about handling dismissals below
                result.dismiss === Swal.DismissReason.cancel
            ) {
                
            }
            })
        },*/

        desactivarDestino(personalDestinos){
            //if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de eliminar este destino', // TITULO 
                    icon: 'question', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#868077', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        //CODIGO HA SER VALIDADO
                        let me =this;
                        this.idPersonalDestino = personalDestinos.idpersonal_destinos,
                        axios
                        .put('/desactivarDestino', {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        idPersonalDestino : me.idPersonalDestino,
                        per_codigo : me.per_codigo,
                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        console.log(response);
                        me.listarPersonalDestinos(me.per_codigo);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
                    }
                })  
           /*}else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2500
                })
            }*/
        },
        /*registrarPersonalDestinos (){
            if(this.validarPersonal_destinos()){
                return;
            }   
        },*/

        generarReporte(per_codigo){
          window.open('http://127.0.0.1:8000/reporte?per_codigo='+per_codigo);
        },
    },
}
</script>