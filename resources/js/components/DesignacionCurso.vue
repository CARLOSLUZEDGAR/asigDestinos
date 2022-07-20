<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              SISCUAPED
              <small>1.0.0</small>
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
                  DESIGNACIÓN DE CURSO DE LOS ESTUDIANTES
                </h3>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                                <select class="form-control col-md-4" v-model="criterio">
                                    <!-- values como la base de datos -->
                                    <option value="est_rude">RUDE</option>
                                    <option value="est_paterno">AP. PATERNO</option>
                                    <option value="est_materno">AP. MATERNO</option>
                                    <option value="est_nombre">NOMBRE(S)</option>
                                    <option value="est_ci">C. IDENTIDAD</option>
                                    <!--<option value="per_paterno">APELLIDO PATERNO</option>-->
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarEstudiantes(1,buscar,criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                <button type="submit" @click="listarEstudiantes(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button><br>
                            </div><br>
                            <!--<div class="form-group row">
                                <button type="button" class="btn btn-primary btn-sm" @click="NuevoEstudiante()">
                                    <i class="far fa-file-alt" aria-hidden="true">  REGISTRAR ESTUDIANTE</i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-primary btn-sm" @click="generarReporte(per_codigo)">
                                    <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                                </button> &nbsp;
                            </div>-->
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th><center>OPCIONES</center></th>
                                <th><center>RUDE</center></th>
                                <th><center>C. IDENTIDAD</center></th>
                                <th><center>AP. PATERNO</center></th>
                                <th><center>AP. MATERNO</center></th>
                                <th><center>NOMBRES</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="estudiante in arrayEstudiante" :key="estudiante.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirDesignar(estudiante)">
                                        <i class="far fa-calendar-check"></i>
                                    </button> &nbsp;
                                    <!--<button type="button" class="btn btn-info btn-sm" @click="abrirEditar(estudiante)">
                                        <i class="fas fa-globe-americas"></i>
                                    </button> &nbsp;
                                    <template v-if="estudiante.est_estado==1">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(usuario.id)" >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)">
                                        <i class="far fa-check-square"></i>
                                    </button>
                                    </template>-->
                                </td>
                                <td v-text="estudiante.est_rude" ></td>
                                <td>{{estudiante.est_ci}} {{estudiante.est_expedido}}</td>
                                <td v-text="estudiante.est_paterno"></td>
                                <td v-text="estudiante.est_materno"></td>
                                <td v-text="estudiante.est_nombre"></td>
                                <!--<td>
                                <div v-if="usuario.estado">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Inactivo</span>
                                </div>
                                </td>-->
                            </tr>
                            
                        </tbody>
                    </table><br>
                    <nav>
                        <!-- inicio para paginacion -->
                       <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                           
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
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
        <!--modal registrar-->
        <div class="modal fade" id="NuevoEstudiante">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">DESTUDIANTE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <!--<div class="col-md-12">
                            <label class="form-control-label" for="text-input">RUDE</label>
                            <input type="text" v-model="est_rude" class="form-control" :class="{ 'is-invalid' : $v.est_rude.$error, 'is-valid':!$v.est_rude.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_rude.required">Este campo es Requerido</span>
                            </div> 
                        </div>-->
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">RUDE</label>
                            <input type="text" v-model="est_rude" class="form-control" > 
                        </div>
                    </div>
                    <div class="form-group row">
                        <!--<div class="col-md-12">
                            <label class="form-control-label" for="text-input">C. IDENTIDAD</label>
                            <input type="text" v-model="est_ci" class="form-control" :class="{ 'is-invalid' : $v.est_ci.$error, 'is-valid':!$v.est_ci.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_ci.required">Este campo es Requerido</span>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">C. IDENTIDAD</label>
                            <input type="text" v-model="est_ci" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <!--<div class="col-md-12">
                            <label class="form-control-label" for="text-input">EXPEDIDO</label>
                            <select class="form-control" v-model="est_expedido" :class="{ 'is-invalid' : $v.est_expedido.$error, 'is-valid':!$v.est_expedido.$invalid }">
                                <option value="0" disabled>SELECCIONAR</option>
                                <option value="LP">LA PAZ</option>
                                <option value="CB">COCHABAMBA</option>
                                <option value="SC">SANTA CRUZ</option>
                                <option value="CH">CHUQUISACA</option>
                                <option value="OR">ORURO</option>
                                <option value="PT">POTOSI</option>
                                <option value="TJ">TARIJA</option>
                                <option value="BN">BENI</option>
                                <option value="PN">PANDO</option>
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_expedido.required">Este campo es Requerido</span>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">EXPEDIDO</label>
                            <select class="form-control" v-model="est_expedido" >
                                <option value="0" disabled>SELECCIONAR</option>
                                <option value="LP">LA PAZ</option>
                                <option value="CB">COCHABAMBA</option>
                                <option value="SC">SANTA CRUZ</option>
                                <option value="CH">CHUQUISACA</option>
                                <option value="OR">ORURO</option>
                                <option value="PT">POTOSI</option>
                                <option value="TJ">TARIJA</option>
                                <option value="BN">BENI</option>
                                <option value="PN">PANDO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!--<div class="col-md-12">
                            <label class="form-control-label" for="text-input">NOMBRE(S)</label>
                            <input type="text" v-model="est_nombre" class="form-control" :class="{ 'is-invalid' : $v.est_nombre.$error, 'is-valid':!$v.est_nombre.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_nombre.required">Este campo es Requerido</span>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">NOMBRE(S)</label>
                            <input type="text" v-model="est_nombre" class="form-control" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <!--<div class="col-md-12">
                            <label class="form-control-label" for="text-input">AP. PATERNO</label>
                            <input type="text" v-model="est_paterno" class="form-control" :class="{ 'is-invalid' : $v.est_paterno.$error, 'is-valid':!$v.est_paterno.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_paterno.required">Este campo es Requerido</span>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">AP. PATERNO</label>
                            <input type="text" v-model="est_paterno" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <!--<div class="col-md-12">
                            <label class="form-control-label" for="text-input">AP. MATERNO</label>
                            <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_materno.required">Este campo es Requerido</span>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">AP. MATERNO</label>
                            <input type="text" v-model="est_materno" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">OBSERVACIONES</label>
                            <textarea name="textarea" class="form-control" rows="3" v-model="est_observacion"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" @click="Cerrar()">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="RegistrarEstudiante()">REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.fin modal registrar -->
      <!--modal actualizar-->
      <div class="modal fade" id="DesignarEstudiante">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">DESIGNAR: <input type="text" v-model="nombre_completo"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="form-control-label" for="text-input">COLEGIO</label>
                    <select class="form-control" v-model="desig_col" >
                        <option value="0" disabled>SELECCIONE</option>
                        <option v-for="colegios in arrayColegios" :key="colegios.id" :value="colegios.id"  v-text="colegios.col_abreviatura"></option>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="form-control-label" for="text-input">NIVEL</label>
                    <select class="form-control" v-model="desig_nivel" >
                        <option value="0" disabled>SELECCIONE</option>
                        <option v-for="niveles in arrayNiveles" :key="niveles.id" :value="niveles.id"  v-text="niveles.nivel_abreviatura"></option>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="form-control-label" for="text-input">CURSO</label>
                    <select class="form-control" v-model="desig_curso" >
                        <option value="0" disabled>SELECCIONE</option>
                        <option v-for="cursos in arrayCursos" :key="cursos.id" :value="cursos.id"  v-text="cursos.curso_sigla"></option>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="form-control-label" for="text-input">PARALELO</label>
                    <select class="form-control" v-model="desig_paralelo" >
                        <option value="0" disabled>SELECCIONAR</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                    </select>
                </div>   
                <div class="form-group row">
                    <!--<div class="col-md-12">-->
                        <label class="form-control-label" for="text-input">OBSERVACIONES</label>
                        <textarea name="textarea" class="form-control" rows="3" v-model="desig_observacion"></textarea>
                    <!--</div>-->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" @click="Cerrar()">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="DesignarEstudiante()">DESIGNAR</button>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      </div>
      <!-- /.fin modal editar -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
  data() {
    return {
      arrayEstudiante : [],
      criterio : 'est_rude',
      buscar : '',

      cod_est : '',
      est_rude : '',
      est_nombre : '',
      est_paterno : '',
      est_materno : '',
      est_ci : '',
      est_expedido : '',
      est_observacion : '',
    
      est_rudeA : '',
      est_nombreA : '',
      est_paternoA : '',
      est_maternoA : '',
      est_ciA : '',
      est_expedidoA : '',
      est_observacionA : '',

      nombre_completo : '',

      desig_col : '',
      desig_nivel : '',
      desig_curso : '',
      desig_paralelo : '',
      desig_observacion : '',

      arrayColegios : [],
      arrayNiveles : [],
      arrayCursos : [],
     // page : 0,
      pagination : {
          'total' : 0,
          'current_page' : 0,
          'per_page' : 0,
          'last_page' : 0,
          'from' : 0,
          'to' : 0,
      },
      offset : 3,
    }
  },

   validations:{
        /*
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

        /*est_rude : { required, $autoDirty: true },
        est_ci : { required, $autoDirty: true },
        est_expedido : { required, $autoDirty: true },
        est_nombre : { required, $autoDirty: true },
        est_paterno : { required, $autoDirty: true },
        est_materno : { required, $autoDirty: true },

        est_rudeA : { required, $autoDirty: true },
        est_ciA : { required, $autoDirty: true },
        est_expedidoA : { required, $autoDirty: true },
        est_nombreA : { required, $autoDirty: true },
        est_paternoA : { required, $autoDirty: true },
        est_maternoA : { required, $autoDirty: true },*/
    },

  mounted() {
    this.listarEstudiantes(this.page,this.buscar,this.criterio);
  },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },

            //Calcuar los elementos de la paginacion
            pagesNumber: function() {
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset *2);
                if( to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while( from <= to){
                    pagesArray.push(from);
                    from ++;
                }
                return pagesArray;
            }
        },
  methods: {

    Cerrar(){
            this.$v.$reset()
        },

    selectColegios(){
        let me = this;
        axios
        .get('/selectColegios')
        .then(function (response) {
    //Respuesta de la peticion
        console.log(response);
        me.arrayColegios = response.data;
        })
        .catch(function (error) {
        // handle error
        console.log(error);
        });
    },

    selectNiveles(){
        let me = this;
        axios
        .get('/selectNiveles')
        .then(function (response) {
    //Respuesta de la peticion
        console.log(response);
        me.arrayNiveles = response.data;
        })
        .catch(function (error) {
        // handle error
        console.log(error);
        });
    },

    selectCursos(){
        let me = this;
        axios
        .get('/selectCursos')
        .then(function (response) {
    //Respuesta de la peticion
        console.log(response);
        me.arrayCursos = response.data;
        })
        .catch(function (error) {
        // handle error
        console.log(error);
        });
    },

    listarEstudiantes(page,buscar,criterio){
            let me = this;
            axios
          .post("/listarEstudiante", {
            page : page,
            buscar : buscar,
            criterio : criterio,
            
          })
          .then(function (response) {
            console.log(response)
            me.arrayEstudiante = response.data.estudiante.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page= page;
                //Envia la peticion para visualizar  la data de esa pagina
                me.listarEstudiantes(page, buscar, criterio);
            },
        EnvioDatos(datos){
            this.$router.push({
                name: "DestinosPersonal",
                //ENVIO DE DATOS
                params:{
                    d: datos
                }
                
            });
        },

        NuevoEstudiante(){
            //this.$v.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            this.est_rude = '',
            this.est_nombre = '',
            this.est_paterno = '',
            this.est_materno = '',
            this.est_ci = '',
            this.est_expedido = '',
            this.est_observacion = ''
            //FIN PONER A CERO MODAL
            $('#NuevoEstudiante').modal('show');
            /*this.obtenerPromocion()
            this.selectDestinos_nivel1()
            this.selectDestinos_nivel2()
            this.selectDestinos_nivel3()
            this.selectDestinos_nivel4()
            this.selectbuscarDestinos_nivel2(this.perdest_destn1_codigo)
            this.selectbuscarDestinos_nivel3(this.perdest_destn2_codigo)
            this.selectbuscarDestinos_nivel4(this.perdest_destn3_codigo)
            this.listarCargos()*/
        },

        RegistrarEstudiante(){
           // if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de registrar a este ESTUDIANTE', // TITULO 
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
                        .post("/registrarEstudiante", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            est_rude : me.est_rude,
                            est_ci : me.est_ci,
                            est_expedido : me.est_expedido,
                            est_nombre : me.est_nombre,
                            est_paterno : me.est_paterno,
                            est_materno : me.est_materno,
                            est_observacion : me.est_observacion,
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            console.log(response);
                            $('#NuevoEstudiante').modal('hide');
                            me.listarEstudiantes(me.page,me.buscar,me.criterio);
                            this.$v.$reset();
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
                //this.$v.$reset();
            }*/
        },

        abrirDesignar(estudiante){
            let me =this;
            this.cod_est = estudiante.id,
            this.nombre_completo = estudiante.est_nombre,
            //this.$v.$reset(),
            $('#DesignarEstudiante').modal('show');
            this.selectColegios();
            this.selectNiveles();
            this.selectCursos();
        },

        DesignarEstudiante(){
           // if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de modificar a esta ESTUDIANTE', // TITULO 
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
                        .put("/designarEstudiante", {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        cod_est : me.cod_est,
                        cod_col : me.desig_col,
                        cod_nivel : me.desig_nivel,
                        cod_curso : me.desig_curso,
                        paralelo : me.desig_paralelo,
                        estc_observacion : me.desig_observacion,
                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        console.log(response);
                        $('#DesignarEstudiante').modal('hide');
                        me.listarEstudiantes(me.page,me.buscar,me.criterio);
                        this.$v.$reset();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
                    }
                })  
           /* }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                //this.$v.$reset();
            }*/
        },
  },
};

</script>

<style>
</style>