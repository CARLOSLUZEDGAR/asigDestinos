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
                  DESTINOS
                </h3>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                                <select class="form-control col-md-4" v-model="criterio">
                                    <!-- values como la base de datos -->
                                    <option value="per_cm">CARNET MILITAR</option>
                                    <option value="per_ci">CARNET DE IDENTIDAD</option>
                                    <option value="per_paterno">APELLIDO PATERNO</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarPersonal(1,buscar,criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                <button type="submit" @click="listarPersonal(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th><center>OPCIONES</center></th>
                                <th><center>CARNET MILITAR</center></th>
                                <th><center>GRADO</center></th>
                                <th><center>AP. PATERNO</center></th>
                                <th><center>AP. MATERNO</center></th>
                                <th><center>NOMBRES</center></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="personal in arrayPersonal">
                                <td>
                                      <button type="button" class="btn btn-primary btn-sm" @click="EnvioDatos(personal.per_codigo)">
                                          <i class="fa fa-eye" aria-hidden="true"></i>
                                      </button> &nbsp;
                                    <!--<template v-if="usuario.estado">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(usuario.id)" >
                                        <i class="icon-trash"></i>
                                    </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                    </template>-->
                                </td>
                                <td v-text="personal.per_cm" ></td>
                                
                                <!--<td v-text="personal.gra_abreviatura" ></td>-->
                                <td>{{personal.gra_abreviatura}}{{personal.estu_abreviatura}}</td>
                                <td v-text="personal.per_paterno"></td>
                                <td v-text="personal.per_materno"></td>
                                <td v-text="personal.per_nombre"></td>
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
                    </table>
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
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      arrayPersonal : [],
      criterio : 'per_cm',
      buscar : '',
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
  mounted() {
    this.listarPersonal(this.page,this.buscar,this.criterio);
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
    listarPersonal(page,buscar,criterio){
            let me = this;
            axios
          .post("/listarPersonal", {
            page : page,
            buscar : buscar,
            criterio : criterio,
            
          })
          .then(function (response) {
            console.log(response)
            me.arrayPersonal = response.data.personal.data
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
                me.listarPersonal(page, buscar, criterio);
            },
        EnvioDatos(datos){
            this.$router.push({
                name: "DestinosPersonal",
                //ENVIO DE DATOS
                params:{
                    d: datos
                }
                
            });
        }
  },
};

</script>

<style>
</style>