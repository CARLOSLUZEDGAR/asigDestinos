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
                                <select class="form-control col-md-6" v-model="nivel" @click="selectBuscarCurso(col_id,nivel)">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="nivel in arrayNiveles" :key="nivel.cod_col" :value="nivel.cod_nivel"  v-text="nivel.nivel_abreviatura"></option>
                                    <!-- <option value="per_paterno">APELLIDO PATERNO</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                            <label class="form-control-label col-md-4" for="text-input">CURSO:</label>
                                <!-- <select class="form-control col-md-6" v-model="cursos" @click="cursosColegio(col_id),reset()"> -->
                                <select class="form-control col-md-6" v-model="curso" @click="selectBuscarParalelo(col_id,nivel,curso)">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="curso in arrayCursos" :key="curso.cod_col" :value="curso.cod_curso"  v-text="curso.curso_sigla"></option>
                                    <!-- <option value="per_paterno">APELLIDO PATERNO</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                            <label class="form-control-label col-md-4" for="text-input">PARALELO:</label>
                                <!-- <select class="form-control col-md-6" v-model="cursos" @click="cursosColegio(col_id),reset()"> -->
                                <select class="form-control col-md-6" v-model="paralelo">
                                    <!-- values como la base de datos -->
                                    <option value="0" disabled>SELECCIONE</option>
                                    <option v-for="paralelo in arrayParalelos" :key="paralelo.cod_col" :value="paralelo.paralelo"  v-text="paralelo.paralelo"></option>
                                    <!-- <option value="per_paterno">APELLIDO PATERNO</option> -->
                                </select>
                            </div>
                        </div>     
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <!-- <th><center>OPCIONES</center></th> -->
                                <th><center>RUDE</center></th>
                                <th><center>C. IDENTIDAD</center></th>
                                <th><center>AP. PATERNO</center></th>
                                <th><center>AP. MATERNO</center></th>
                                <th><center>NOMBRES</center></th>
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
                    <div class="row p-2 bd-highlight justify-content-center">

                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" @click="listarEstudiantes(1,col_id,nivel,curso,paralelo)">
                                <i class="fas fa-reply" aria-hidden="true">  MOSTRAR ESTUDIANTES</i>
                            </button>
                        </div>
                        
                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras(col_id)">
                                <i class="fas fa-reply" aria-hidden="true">  ATRAS</i>
                            </button>
                        </div> 
                    </div>

                    <div v-if="boton == 1" class="row p-2 bd-highlight justify-content-center">

                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-sm btn-block" @click="reporteListarEstudiantes(col_id,nivel,curso,paralelo)">
                                <i class="far fa-file-alt" aria-hidden="true">  GENERAR LISTADO</i>
                            </button>
                        </div>
                         
                    </div>
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
            arrayCursos : [],
            arrayParalelos : [],
            arrayEstudiantesCurso : [],
            nivel : '',
            curso : '',
            paralelo : '',


            boton : 0,
            // arrayPerPromo : [],
            // arrayPerEspecialidad : [],
            // arrayPerGrado : [],
            // arrayPerDestino : [],
            // arrayGrados : [],
            // arrayEspecialidad : [],
            // arraySubespecialidad : [],
            // arrayDestinos_nivel1 : [],
            // arrayDestinos_nivel2 : [],
            // arrayDestinos_nivel3 : [],
            nivel_cod : '',
            curso_cod : '',
            grado :  0,
            especialidad : 0,
            subespecialidad : 0,
            entidad : 0,
            gran_unidad : 0,
            reparticion : 0,
            
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
        //this.ver();
        // this.listarPerPromo(this.page,this.promocion,this.especialidad,this.subespecialidad);
        // this.cursosColegio(this.col_id);
        this.selectBuscarNivel(this.col_id);
        // this.selectBuscarCurso(this.col_id,this.nivel_cod);
        // this.selectBuscarParalelo(this.col_id,this.nivel_cod,this.curso_cod)

        // this.datosPersonal(this.per_codigo);
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
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },

        // INICIO BUSCAR POR PROMOCION
        listarEstudiantes(page,col_id,nivel,curso,paralelo){
            let me = this;
            me.boton = 1;
            axios
          .post("/estudiantesCurso", {
            page : page,
            col_id : col_id,
            nivel : nivel,
            curso : curso,
            paralelo : paralelo  
          })
          .then(function (response) {
            console.log(response)
            me.arrayEstudiantesCurso = response.data.estudiantesCurso.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        cambiarPagina(page, promocion,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerPromo(page, promocion,especialidad,subespecialidad);
        },
        // FIN BUSCAR POR PROMOCION

        listarPerGrado(page,grado,especialidad,subespecialidad){
            let me = this;
            axios
        
          .post("/listarPerGrado", {
            page : page,
            grado : grado,
            especialidad : especialidad,
            subespecialidad : subespecialidad
          })
          .then(function (response) {
            
            me.arrayPerGrado = response.data.personal_especialidades.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        cambiarPaginaGrado(page, grado,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerGrado(page, grado,especialidad,subespecialidad);
        },
        // FIN BUSCAR POR GRADO

        //INICIO BUSQUEDA POR ESPECIALIDAD Y SUBESPECIALIDAD
        // listarPerEspecialidad(page,especialidad,subespecialidad){
        //     let me = this;
        //     axios
        
        //   .post("/listarPerEspecialidad", {
        //     page : page,
        //     especialidad : especialidad,
        //     subespecialidad : subespecialidad
        //   })
        //   .then(function (response) {
            
        //     me.arrayPerEspecialidad = response.data.personal_especialidades.data
        //     me.pagination = response.data.pagination;
        //   })
        //   .catch(function (error) {
        //     // handle error
        //     console.log(error);
        //   })
        // },

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

        selectBuscarCurso(col_id,nivel){
            let me = this;
            axios
            .post('/cursosColegio',{
                col_id : col_id,
                nivel_cod : nivel
            })
            .then(function (response){
                console.log(response)
                me.arrayCursos = response.data;
            })
            .catch(function (error){
                console.log(error);
            })
        },

        selectBuscarParalelo(col_id,nivel,curso){
            let me = this;
            axios
            .post('/paralelosColegio',{
                col_id : col_id,
                nivel_cod : nivel,
                curso_cod : curso
            })
            .then(function (response){
                console.log(response)
                me.arrayParalelos = response.data;
            })
            .catch(function (error){
                console.log(error);
            })
        },

        // changeItemCurso: function changeItemCurso(rowId, event) {
        //     this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
        //     this.selectBuscarCurso(event.target.value);
        // },

        // cursosColegio(col_id){
        //     let me = this;
        //     axios
        //     .post('/cursosColegio', {
        //         col_id : col_id
        //     })
        //     .then(function (response) {
        //         console.log(response)
        //         me.arrayCursosColegio = response.data; 
        //     })
        //     .catch(function (error) {
        //         // handle error
        //         console.log(error);
        //     })
        // },

        selectSubespecialidad(){
            let me =this;
            var url='/subespecialidad/selectSubespecialidad';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arraySubespecialidad = respuesta.subespecialidad; 
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        changeItemEspe: function changeItemEspe(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectBuscarCurso(event.target.value);
        },

        selectbuscarSubespecialidad(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arraySubespecialidad=[];
          //  me.prov_codigo=0;
            var url='/subespecialidad/selectbuscarSubespecialidad?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arraySubespecialidad = respuesta.subespecialidad; 
                
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

        cambiarPaginaEspecialidad(page,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerEspecialidad(page,especialidad,subespecialidad);
        },
        //FIN BUSQUEDA POR ESPECIALIDAD Y SUBESPECIALIDAD

        // INICIO BUSQUEDA POR DESTINO
        listarPerDestino(page,entidad,gran_unidad,reparticion,especialidad,subespecialidad){
            let me = this;
            axios
        
          .post("/listarPerDestino", {
            page : page,
            entidad : entidad,
            gran_unidad : gran_unidad,
            reparticion : reparticion,
            especialidad : especialidad,
            subespecialidad : subespecialidad
          })
          .then(function (response) {
            
            me.arrayPerDestino = response.data.personal_especialidades.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        changeItemEntidad: function changeItemEntidad(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel2(event.target.value);
        },
        changeItemGranunidad: function changeItemGranunidad(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel3(event.target.value);
        },
        
        selectDestinos_nivel1(){
            let me =this;
            var url='/destinos_nivel1/selectDestinos_nivel1';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel1 = respuesta.destino1; 
              
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
                me.arrayDestinos_nivel2 = respuesta.destinos2; 
              
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
                me.arrayDestinos_nivel3 = respuesta.destino3; 
              
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
                me.arrayDestinos_nivel2 = respuesta.destinos2; 
                
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
                me.arrayDestinos_nivel3 = respuesta.destino3; 
                
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

        cambiarPaginaDestino(page,entidad,gran_unidad,reparticion,especialidad,subespecialidad){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPerDestino(page,entidad,gran_unidad,reparticion,especialidad,subespecialidad);
        },
        // FIN BUSQUEDA POR DESTINO

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

        reporteListarEstudiantes(col_id,nivel,curso,paralelo){
            window.open('http://127.0.0.1:8000/reporteListarEstudiantes?idcol='+col_id+'&idnivel='+nivel+'&idcurso='+curso+'&idparalelo='+paralelo);

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
