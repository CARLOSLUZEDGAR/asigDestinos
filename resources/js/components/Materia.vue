<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
                Cursos
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cursos</li>
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
                  <strong>CURSOS</strong>
                </h3>
              </div>
              <div class="card-body">               
                    <!-- @click="selectEspeGrado()" -->
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                            <label class="form-control-label col-md-4" for="text-input">NIVEL:</label>
                                <!-- <select class="form-control col-md-6" v-model="cursos" @click="cursosColegio(col_id),reset()"> -->
                                <select class="form-control col-md-6" v-model="nivel" @click="selectBuscarCampo(nivel)">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="nivel in arrayNiveles" :key="nivel.cod_col" :value="nivel.cod_nivel"  v-text="nivel.nivel_abreviatura"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                            <label class="form-control-label col-md-4" for="text-input">CAMPO:</label>
                                <!-- <select class="form-control col-md-6" v-model="cursos" @click="cursosColegio(col_id),reset()"> -->
                                <select class="form-control col-md-6" v-model="campo" @click="selectBuscarArea(campo)">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="campo in arrayCampos" :key="campo.id" :value="campo.id"  v-text="campo.campo_nombre"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                            <label class="form-control-label col-md-4" for="text-input">ARÉA:</label>
                                <!-- <select class="form-control col-md-6" v-model="cursos" @click="cursosColegio(col_id),reset()"> -->
                                <select class="form-control col-md-6" v-model="area">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="area in arrayAreas" :key="area.id" :value="area.id"  v-text="area.area_nombre"></option>
                                </select>
                            </div>
                        </div>  
                    </div>

                    <div class="row p-2 bd-highlight justify-content-center">                        
                        <div class="col-md-4">
                            <button type="button" class="btn btn-info btn-sm btn-block" @click="Atras(col_id)">
                                <i class="fas fa-plus" aria-hidden="true">  AÑADIR</i>
                            </button>
                        </div> 
                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras(col_id)">
                                <i class="fas fa-reply" aria-hidden="true">  ATRAS</i>
                            </button>
                        </div> 
                    </div>

                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <!-- <th><center>OPCIONES</center></th> -->
                                <th><center>NIVEL</center></th>
                                <th><center>CAMPO</center></th>
                                <th><center>ARÉA</center></th>
                                <th><center>OPCIONES</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="estudiantesCurso in arrayEstudiantesCurso" :key="estudiantesCurso.id">
                                <!-- <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirEditar(estudiante)">
                                        <i class="fas fa-edit"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-info btn-sm" @click="abrirEditar(estudiante)">
                                        <i class="fas fa-globe-americas"></i>
                                    </button> &nbsp;
                                    <template v-if="estudiantesCurso.est_estado==1">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarEstudiante(usuario.id)" >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)">
                                        <i class="far fa-check-square"></i>
                                    </button>
                                    </template>
                                </td> -->
                                <td v-text="estudiantesCurso.est_rude" ></td>
                                <td>{{estudiantesCurso.est_ci}} {{estudiantesCurso.est_expedido}}</td>
                                <td v-text="estudiantesCurso.est_paterno"></td>
                                <td v-text="estudiantesCurso.est_materno"></td>
                                <td v-text="estudiantesCurso.est_nombre"></td>
                                <!-- <td v-text="estudiantesCurso.nivel_abreviatura"></td>
                                <td>{{estudiantesCurso.curso_sigla}} "{{estudiantesCurso.paralelo}}"</td> -->
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
                    

                    <!-- INICIO MOSTRAR DATOS POR PROMOCION -->
                   
                        
                        <div class="form-group row">
                            <nav>
                                <!-- inicio para paginacion -->
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,promocion,especialidad,subespecialidad)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,promocion,especialidad,subespecialidad)" v-text="page"></a>
                                    </li>
                                
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,promocion,especialidad,subespecialidad)">Sig</a>
                                    </li>
                                </ul>
                                <!-- fin paginacion -->
                            </nav>
                        </div>
                    
                    <!-- FIN MOSTRAR DATOS POR PROMOCION -->

                    <!-- <div class="row p-2 bd-highlight justify-content-center">

                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger btn-sm btn-block" @click="listarEstudiantes(1,col_id,nivel,curso,paralelo)">
                                <i class="fas fa-reply" aria-hidden="true">  MOSTRAR ESTUDIANTES</i>
                            </button>
                        </div>
                        
                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras(col_id)">
                                <i class="fas fa-reply" aria-hidden="true">  ATRAS</i>
                            </button>
                        </div> 
                    </div> -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
      
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
            col_id: this.$route.params.d,
            arrayCursosColegio : [],
            arrayNiveles : [],
            arrayCampos : [],
            arrayAreas : [],
            arrayEstudiantesCurso : [],
            nivel : '',
            campo : '',
            area : '',
            
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            rowId : 0,
        }
    },

    validations:{
        
    },

    mounted() {
        
        this.selectBuscarNivel(this.col_id);
        
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
       
        cambiarPaginaGrado(page, grado,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerGrado(page, grado,especialidad,subespecialidad);
        },
        

        selectBuscarNivel(col_id){
            let me = this;
            axios
            .post('/nivelesColegio', {
                col_id : col_id
            })
            .then(function (response) {
                console.log(response)
                me.arrayNiveles = response.data; 
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        selectBuscarCampo(nivel){
            let me = this;
            axios
            .post('/campoNivel',{
                nivel_cod : nivel
            })
            .then(function (response){
                console.log(response)
                me.arrayCampos = response.data;
            })
            .catch(function (error){
                console.log(error);
            })
        },

        selectBuscarArea(campo){
            let me = this;
            axios
            .post('/areaCampo',{
                campo_cod : campo
            })
            .then(function (response){
                console.log(response)
                me.arrayAreas = response.data;
            })
            .catch(function (error){
                console.log(error);
            })
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

        reset(){
            let me = this;
            me.promocion = '';
            me.grado = 0;
            me.especialidad = 0;
            me.subespecialidad = 0;
            me.entidad = 0;
            me.gran_unidad = 0;
            me.reparticion = 0;
        },

        RepPromEspe(promocion,especialidad,subespecialidad){
            window.open('http://127.0.0.1:8000/reporteEspecialidadPromocion?promocion='+promocion+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);

            // let me = this;
            // axios
            // .post("/registrarReporte", {
            // //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
            //     rep_reporte : 'CERTIFICADO DESTINOS ASCENSO',
            //     rep_per_codigo : me.per_codigo,
            //     rep_observacion : me.notaAsc,
            // })
            // .then(function (response) {
            //     //Respuesta de la peticion
                
            // })
            // .catch(function (error) {
            //     // handle error
            //     console.log(error);
            // });
        },

        RepGraEspe(grado,especialidad,subespecialidad){
            window.open('http://127.0.0.1:8000/reporteEspecialidadGrado?grado='+grado+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);
        },

        RepEspeEspe(especialidad,subespecialidad){
            window.open('http://127.0.0.1:8000/reporteEspecialidadEspecialidad?especialidad='+especialidad+'&subespecialidad='+subespecialidad);
        },

        RepDestEspe(entidad,gran_unidad,reparticion,especialidad,subespecialidad){
            window.open('http://127.0.0.1:8000/reporteEspecialidadDestino?entidad='+entidad+'&gran_unidad='+gran_unidad+'&reparticion='+reparticion+'&especialidad='+especialidad+'&subespecialidad='+subespecialidad);
        },
        
    },
}
</script>
