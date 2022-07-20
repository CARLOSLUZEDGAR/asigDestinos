<template>
  <main>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th style="width: 100px" class="text-center">OPCIONES</th>
                    <th style="width: 200px" class="text-center">NOMBRE</th>
                    <th style="width: 350px" class="text-center">PATERNO</th>
                    <th style="width: 350px" class="text-center">MATERNO</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="p in personal">
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" @click="EnvioNombre(p)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button> &nbsp;
                        <button type="button" class="btn btn-warning btn-sm " @click="editarEvaluadores(ds.destino1,ds.destino2,ds.destino3,ds.destino4)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                    <td v-text="p.per_nombre"></td>
                    <td>{{p.per_paterno}}</td>
                    <td>{{p.per_materno}}</td>
                </tr>
            </tbody>   
        </table>
  </main>
</template>

<script>
export default {
    data() {
        return {
            personal: []
        }
    },
    //FUNCION IMPORTANTE CUANDO INICIE PANTALLA LO PRIMERO Q SE VE
    mounted() {
        this.listarPersonal();
    },
    methods: {
        listarPersonal(){
            let me = this;
            axios
            .get('/listarPersonal')
            .then(function (response) {
                console.log(response);
                me.personal = response.data;
            })
            .catch(function (error) {
                //handle error
                console.log(error);
            });
        },

        EnvioNombre(nombre){
            this.$router.push({
                name: "DatoPersonal",
                //ENVIO DE DATOS
                params:{
                    n: nombre
                }
                
            });
        }
    },

}
</script>

<style>

</style>