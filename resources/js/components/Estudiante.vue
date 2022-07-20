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
                  ESTUDIANTES
                </h3>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                                <!-- <select class="form-control col-md-4" v-model="criterio">
                                    <option value="est_rude">RUDE</option>
                                    <option value="est_paterno">AP. PATERNO</option>
                                    <option value="est_materno">AP. MATERNO</option>
                                    <option value="est_nombre">NOMBRE(S)</option>
                                    <option value="est_ci">C. IDENTIDAD</option>
                                </select> -->
                                <input type="text" v-model="buscar" @keyup="buscarEstudiante()" class="form-control" style="text-transform: uppercase"><br>
                                <span class="input-group-text border-0" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </span>
                                <!-- <input type="text" v-model="buscar" @keyup.enter="listarEstudiantes(1,buscar,criterio,col_id)" class="form-control" placeholder="TEXTO A BUSCAR">
                                <button type="submit" @click="listarEstudiantes(1,buscar,criterio,col_id)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button><br> -->
                            </div><br>
                            <div class="form-group row">
                                <button type="button" class="btn btn-primary btn-sm" @click="NuevoEstudiante()">
                                    <i class="far fa-file-alt" aria-hidden="true">  REGISTRAR ESTUDIANTE</i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-primary btn-sm" @click="generarReporte(per_codigo)">
                                    <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras(col_id)">
                                    <i class="fas fa-reply" aria-hidden="true"> Volver Atrás</i>
                                </button> &nbsp;
                            </div>
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
                                <th><center>NIVEL</center></th>
                                <th><center>CURSO</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="estudiante in arrayEstudiante" :key="estudiante.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirEditar(estudiante)">
                                        <i class="fas fa-edit"></i>
                                    </button> &nbsp;
                                    <!-- <button type="button" class="btn btn-info btn-sm" @click="abrirEditar(estudiante)">
                                        <i class="fas fa-globe-americas"></i>
                                    </button> &nbsp; -->
                                    <template v-if="estudiante.est_estado==1">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarEstudiante(estudiante.id)" >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)">
                                        <i class="far fa-check-square"></i>
                                    </button>
                                    </template>
                                </td>
                                <td v-text="estudiante.est_rude" ></td>
                                <td>{{estudiante.est_ci}} {{estudiante.est_expedido}}</td>
                                <td v-text="estudiante.est_paterno"></td>
                                <td v-text="estudiante.est_materno"></td>
                                <td v-text="estudiante.est_nombre"></td>
                                <td v-text="estudiante.nivel_abreviatura"></td>
                                <td>{{estudiante.curso_sigla}} "{{estudiante.paralelo}}"</td>
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
        <div class="modal fade" id="NuevoEstudiante">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR ESTUDIANTE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12" style="text-align: center; font-size: 14pt; font-weight: bold;">
                           DATOS DEL ESTUDIANTE
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">RUDE</label>
                            <input type="text" v-model="est_rude" class="form-control" :class="{ 'is-invalid' : $v.est_rude.$error, 'is-valid':!$v.est_rude.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_rude.required">Este campo es Requerido</span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">C. IDENTIDAD</label>
                            <input type="text" v-model="est_ci" class="form-control" :class="{ 'is-invalid' : $v.est_ci.$error, 'is-valid':!$v.est_ci.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_ci.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">NOMBRE(S)</label>
                            <input type="text" v-model="est_nombre" class="form-control" :class="{ 'is-invalid' : $v.est_nombre.$error, 'is-valid':!$v.est_nombre.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_nombre.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">AP. PATERNO</label>
                            <input type="text" v-model="est_paterno" class="form-control" :class="{ 'is-invalid' : $v.est_paterno.$error, 'is-valid':!$v.est_paterno.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_paterno.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">AP. MATERNO</label>
                            <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_materno.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" style="text-align: center; font-size: 14pt; font-weight: bold;">
                           ASIGNACIÓN DE CURSO
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">NIVEL</label>
                            <!-- <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }"> -->
                                <select class="form-control" v-model="desig_nivel" :class="{ 'is-invalid' : $v.desig_nivel.$error, 'is-valid':!$v.desig_nivel.$invalid }">
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="niveles in arrayNiveles" :key="niveles.id" :value="niveles.id"  v-text="niveles.nivel_abreviatura"></option>
                                </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.desig_nivel.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">CURSO</label>
                            <!-- <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }"> -->
                             <select class="form-control" v-model="desig_curso" :class="{ 'is-invalid' : $v.desig_curso.$error, 'is-valid':!$v.desig_curso.$invalid }">
                                <option value="0" disabled>SELECCIONE</option>
                                <option v-for="cursos in arrayCursos" :key="cursos.id" :value="cursos.id"  v-text="cursos.curso_sigla"></option>
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.desig_curso.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">PARALELO</label>
                            <!-- <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }"> -->
                            <select class="form-control" v-model="desig_paralelo" :class="{ 'is-invalid' : $v.desig_paralelo.$error, 'is-valid':!$v.desig_paralelo.$invalid }">
                                <option value="0" disabled>SELECCIONE</option>
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
                            <div class="invalid-feedback">
                                <span v-if="!$v.desig_paralelo.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">GESTIÓN</label>
                            <input type="text" v-model="gestion" class="form-control" :class="{ 'is-invalid' : $v.gestion.$error, 'is-valid':!$v.gestion.$invalid }">
                        </div>
                        <div class="invalid-feedback">
                            <span v-if="!$v.gestion.required">Este campo es Requerido</span>
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
      <!-- /.modal registrar -->
      <div class="modal fade" id="EditarEstudiante">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR ESTUDIANTE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">RUDE</label>
                            <input type="text" v-model="est_rudeA" class="form-control" :class="{ 'is-invalid' : $v.est_rudeA.$error, 'is-valid':!$v.est_rudeA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_rudeA.required">Este campo es Requerido</span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">C. IDENTIDAD</label>
                            <input type="text" v-model="est_ciA" class="form-control" :class="{ 'is-invalid' : $v.est_ciA.$error, 'is-valid':!$v.est_ciA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_ciA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">EXPEDIDO</label>
                            <select class="form-control" v-model="est_expedidoA" :class="{ 'is-invalid' : $v.est_expedidoA.$error, 'is-valid':!$v.est_expedidoA.$invalid }">
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
                                <span v-if="!$v.est_expedidoA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        
                    </div> -->
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">NOMBRE(S)</label>
                            <input type="text" v-model="est_nombreA" class="form-control" :class="{ 'is-invalid' : $v.est_nombreA.$error, 'is-valid':!$v.est_nombreA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_nombreA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>

                     <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">AP. PATERNO</label>
                            <input type="text" v-model="est_paternoA" class="form-control" :class="{ 'is-invalid' : $v.est_paternoA.$error, 'is-valid':!$v.est_paternoA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_paternoA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">AP. MATERNO</label>
                            <input type="text" v-model="est_maternoA" class="form-control" :class="{ 'is-invalid' : $v.est_maternoA.$error, 'is-valid':!$v.est_maternoA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.est_maternoA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12" style="text-align: center; font-size: 14pt; font-weight: bold;">
                           ASIGNACIÓN DE CURSO
                        </div>
                    </div>

                   <div class="form-group row">
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">NIVEL</label>
                            <!-- <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }"> -->
                                <select class="form-control" v-model="desig_nivelA" :class="{ 'is-invalid' : $v.desig_nivelA.$error, 'is-valid':!$v.desig_nivelA.$invalid }">
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="niveles in arrayNiveles" :key="niveles.id" :value="niveles.id"  v-text="niveles.nivel_abreviatura"></option>
                                </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.desig_nivelA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">CURSO</label>
                            <!-- <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }"> -->
                             <select class="form-control" v-model="desig_cursoA" :class="{ 'is-invalid' : $v.desig_cursoA.$error, 'is-valid':!$v.desig_cursoA.$invalid }">
                                <option value="0" disabled>SELECCIONE</option>
                                <option v-for="cursos in arrayCursos" :key="cursos.id" :value="cursos.id"  v-text="cursos.curso_sigla"></option>
                            </select>
                            <div class="invalid-feedback">
                                <span v-if="!$v.desig_cursoA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">PARALELO</label>
                            <!-- <input type="text" v-model="est_materno" class="form-control" :class="{ 'is-invalid' : $v.est_materno.$error, 'is-valid':!$v.est_materno.$invalid }"> -->
                            <select class="form-control" v-model="desig_paraleloA" :class="{ 'is-invalid' : $v.desig_paraleloA.$error, 'is-valid':!$v.desig_paraleloA.$invalid }">
                                <option value="0" disabled>SELECCIONE</option>
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
                            <div class="invalid-feedback">
                                <span v-if="!$v.desig_paraleloA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-control-label" for="text-input">GESTIÓN</label>
                            <input type="text" v-model="gestionA" class="form-control" :class="{ 'is-invalid' : $v.gestionA.$error, 'is-valid':!$v.gestionA.$invalid }">
                        </div>
                        <div class="invalid-feedback">
                            <span v-if="!$v.gestionA.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">OBSERVACIONES</label>
                            <textarea name="textarea" class="form-control" rows="3" v-model="est_observacionA"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" @click="Cerrar()">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="EditarEstudiante()">ACTUALIZAR</button>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      </div>
      <!-- /.modal editar -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            col_id: this.$route.params.d,
            arrayEstudiante : [],
            arrayNiveles : [],
            estcur_id : '',
            arrayCursos : [],
            criterio : 'est_rude',
            buscar : '',
            setTiemoutBuscador : '',

            est_rude : '',
            est_nombre : '',
            est_paterno : '',
            est_materno : '',
            est_ci : '',
            est_expedido : '',
            est_observacion : '',
            desig_nivel : '',
            desig_curso : '',
            desig_paralelo : '',
            gestion : '',

            est_rudeA : '',
            est_nombreA : '',
            est_paternoA : '',
            est_maternoA : '',
            est_ciA : '',
            est_expedidoA : '',
            est_observacionA : '',
            desig_nivelA : '',
            desig_cursoA : '',
            desig_paraleloA : '',
            gestionA : '',
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

        est_rude : { required },
        est_ci : { required },
        est_expedido : { required },
        est_nombre : { required },
        est_paterno : { required },
        est_materno : { required },
        desig_nivel : {required},
        desig_curso : {required},
        desig_paralelo : {required},
        gestion : {required},

        est_rudeA : { required },
        est_ciA : { required },
        est_expedidoA : { required },
        est_nombreA : { required },
        est_paternoA : { required },
        est_maternoA : { required },
        desig_nivelA : {required},
        desig_cursoA : {required},
        desig_paraleloA : {required},
        gestionA : {required},

        validationGroupReg: ['est_rude', 'est_ci', 'est_expedido', 'est_nombre', 'est_paterno', 'est_materno','desig_nivel','desig_curso','desig_paralelo','gestion'],
        validationGroupEdit: ['est_rudeA', 'est_ciA', 'est_expedidoA', 'est_nombreA', 'est_paternoA', 'est_maternoA','desig_nivelA','desig_cursoA','desig_paraleloA','gestionA'],
    },

    mounted() {
        this.listarEstudiantes(this.page);
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

    listarEstudiantes(page){
            let me = this;
            axios
          .post("/listarEstudiante", {
            page : page,
            buscar : me.buscar.toUpperCase(),
            col_id : me.col_id  
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

        buscarEstudiante(){
            clearTimeout(this.setTiemoutBuscador);
            this.setTiemoutBuscador = setTimeout(() => {
                this.listarEstudiantes(1)
                // console.log(this.buscar);
            }, 360)
        },

    
        cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page= page;
                //Envia la peticion para visualizar  la data de esa pagina
                me.listarEstudiantes(page, buscar, criterio, col_id);
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
        //ABRIR MODAL REGISTRO
        NuevoEstudiante(){
            this.$v.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            this.est_rude = '',
            this.est_nombre = '',
            this.est_paterno = '',
            this.est_materno = '',
            this.est_ci = '',
            this.est_expedido = '',
            this.est_observacion = '',
            this.desig_nivel = '',
            this.desig_curso = '',
            this.desig_paralelo = '',
            this.gestion = '',
            //FIN PONER A CERO MODAL
            $('#NuevoEstudiante').modal('show');
            // this.obtenerPromocion()
            this.selectNiveles()
            this.selectCursos()
            // this.selectDestinos_nivel3()
            // this.selectDestinos_nivel4()
            // this.selectbuscarDestinos_nivel2(this.perdest_destn1_codigo)
            // this.selectbuscarDestinos_nivel3(this.perdest_destn2_codigo)
            // this.selectbuscarDestinos_nivel4(this.perdest_destn3_codigo)
            // this.listarCargos()
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

        RegistrarEstudiante(){
            this.$v.$reset();
            if(!this.$v.validationGroupReg.$invalid){
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
                            cod_col : me.col_id,
                            cod_nivel : me.desig_nivel,
                            cod_curso : me.desig_curso,
                            paralelo : me.desig_paralelo,
                            gestion : me.gestion
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            console.log(response);
                            $('#NuevoEstudiante').modal('hide');
                            me.listarEstudiantes(me.page,me.buscar,me.criterio,me.col_id);
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
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                //this.$v.$reset();
            }
        },

        abrirEditar(estudiante){
            let me =this;
            this.$v.$reset(),
            this.est_id = estudiante.id,
            this.estcur_id = estudiante.estcurid,
            this.est_rudeA = estudiante.est_rude,
            this.est_ciA = estudiante.est_ci,
            this.est_expedidoA = estudiante.est_expedido,
            this.est_nombreA = estudiante.est_nombre,
            this.est_paternoA = estudiante.est_paterno,
            this.est_maternoA = estudiante.est_materno,
            this.est_observacionA = estudiante.est_observacion,
            this.desig_nivelA = estudiante.cod_nivel,
            this.desig_cursoA = estudiante.cod_curso,
            this.desig_paraleloA = estudiante.paralelo,
            this.gestionA = estudiante.gestion,
            $('#EditarEstudiante').modal('show');
            this.selectNiveles()
            this.selectCursos()
        },

        EditarEstudiante(){
            this.$v.$reset();
            if(!this.$v.validationGroupEdit.$invalid){
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
                        .put("/editarEstudiante", {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        est_id : me.est_id,
                        est_rude : me.est_rudeA,
                        est_ci : me.est_ciA,
                        est_expedido : me.est_expedidoA,
                        est_nombre : me.est_nombreA,
                        est_paterno : me.est_paternoA,
                        est_materno : me.est_maternoA,
                        est_observacion : me.est_observacionA,
                        estcur_id : me.estcur_id,
                        cod_nivel : me.desig_nivelA,
                        cod_curso : me.desig_cursoA,
                        paralelo : me.desig_paraleloA,
                        gestion : me.gestionA

                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        console.log(response);
                        $('#EditarEstudiante').modal('hide');
                        me.listarEstudiantes(me.page,me.buscar,me.criterio,me.col_id);
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
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                //this.$v.$reset();
            }
        },

        Atras(datos){
            this.$router.push({
                name: "OpcionColegios",
                // ENVIO DE DATOS
                params:{
                    d: datos
                }
                
            });
        },
  },
};

</script>

<style>
</style>