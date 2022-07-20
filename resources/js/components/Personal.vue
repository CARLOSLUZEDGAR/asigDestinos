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
                                <input type="text" v-model="buscar" @keyup="buscarPersonal()" class="form-control" style="text-transform: uppercase"><br>
                                <div class="input-group-text border-0" id="search-addon">
                                    <i class="icon-magnifier"></i>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <template v-if="arrayPersonal.length"> 
                      <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;"> 
                        <table class="table table-bordered table-striped table-sm">
                          <thead>
                            <tr> 
                              <th style="text-align:center">Grado</th>
                              <th style="text-align:center">Apellidos y Nombres</th>
                              <th style="text-align:center">C. Militar</th>
                              <th style="text-align:center">C. Identidad</th>
                              <th style="text-align:center">Opciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="personal in arrayPersonal" :key="personal.per_codigo"> 
                              <td style="text-align:left">{{personal.gra_abreviatura}}{{personal.estu_abreviatura}}</td>
                              <td style="text-align:left" v-text="personal.completo"></td>
                              <td style="text-align:center" v-text="personal.per_cm" ></td>
                              <td style="text-align:center" v-text="personal.per_ci" ></td>
                              <td style="text-align:center">
                                <button type="button" class="btn btn-success btn-sm" @click="EnvioDatos(personal.per_codigo)" v-tooltip.top-center="'Datos'">
                                  <i class="icon-arrow-right-circle" aria-hidden="true"></i>
                                </button>
                              </td>
                            </tr>  
                          </tbody>
                        </table>
                      </div>  
                    </template>
                    <template v-else>
                        <div class="callout callout-info">
                            <h5><i class="icon-hourglass"></i> No se encontraron resultados...</h5>
                        </div>
                    </template>
                    <div class="form-group row">
                      <nav>
                            <!-- inicio para paginacion -->
                        <ul class="pagination">
                          <li class="page-item" v-if="pagination.current_page > 1">
                              <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                          </li>
                          <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                              <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                          </li>
                          
                          <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                              <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                          </li>
                        </ul>
                            <!-- fin paginacion -->
                      </nav>
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
export default {
  data() {
    return {
      arrayPersonal : [],
      criterio : 'per_cm',
      setTiemoutBuscador : '',
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
    this.listarPersonal(this.page);
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
    listarPersonal(page){
        let me = this;
        axios
        .post("/PersonalList", {
          page : page,
          buscar : me.buscar.toUpperCase(),
          // criterio : criterio,
          
        })
        .then(function (response) {
         // console.log(response)
          me.arrayPersonal = response.data.personal.data
          me.pagination = response.data.pagination;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

        buscarPersonal(){
          clearTimeout(this.setTiemoutBuscador);
          this.setTiemoutBuscador = setTimeout(() => {
              this.listarPersonal(1)
              // console.log(this.buscar);
          }, 360)
        },

        cambiarPagina(page){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page= page;
                //Envia la peticion para visualizar  la data de esa pagina
                me.listarPersonal(page);
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