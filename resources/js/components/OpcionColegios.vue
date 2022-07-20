<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
             <h1>
                <i class="far fa-bookmark"></i>
                Opciones Unidad Educativa
            </h1>&nbsp;
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Opciones Unidad Educativa</li>
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <img v-bind:src="'../img/colegio/'+arrayDatosColegio.col_foto" class="rounded float-left img-fluid" width="150" height="150" style="border: 2px solid blue;">
                            </div>
                    
                            <div class="col-md-10 d-flex align-items-center">
                                <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                    <!-- FILA 1 -->
                                    <div class="row p-2 bd-highlight">
                                        <div class="col-md-6">
                                            <dl>
                                                <dt class="st">UNIDAD EDUCATIVA</dt>
                                                <dd class="st">{{arrayDatosColegio.col_abreviatura}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-4">
                                            <dl>
                                                <dt class="st">SIE</dt>
                                                <dd class="st">{{arrayDatosColegio.col_sie}}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <!-- FILA 2 -->
                                    <div class="row p-2 bd-highlight">
                                        <div class="col-md-4">
                                            <dl>
                                                <dt class="st">DISTRITO</dt>
                                                <!-- <dd class="st">{{arrayDatosPersonal.per_ci}} {{arrayDatosPersonal.per_expedido}}</dd> -->
                                            </dl>
                                        </div>
                                        <div class="col-md-4">
                                            <dl>
                                                <dt class="st">TURNO</dt>
                                                <dd class="st">{{arrayDatosColegio.col_turno}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-4">
                                            <dl>
                                                <dt class="st">DEPENDENCIA</dt>
                                                <dd class="st">{{arrayDatosColegio.col_dependencia}}</dd>
                                            </dl>
                                        </div>

                                    </div>
                                    <!-- FILA 3 -->
                                    <div class="row p-2 bd-highlight justify-content-center">
                                        <div class="col-md-3">
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="EnvioDatos(col_id)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  REGISTRO DE ESTUDIANTES</i>
                                            </button> &nbsp;
                                        </div>
                                        <div class="col-md-3"> 
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="EnvioDatosCurso(col_id)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  CURSOS</i>
                                            </button> &nbsp;
                                        </div>
                                        <div class="col-md-3">
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="EnvioDatosAsignacion(col_id)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  ASIGNACIÓN DE MATERIAS</i>
                                            </button> &nbsp;
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="CertTrabajo(per_codigo)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  Certificado de Trabajo</i>
                                            </button> &nbsp;
                                        </div> -->
                                    </div>

                                    <!-- FILA 3 -->
                                    <div class="row p-2 bd-highlight justify-content-center">
                                        <!-- <div class="col-md-3">
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="CurrVitae(per_codigo)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  Curriculum Vitae</i>
                                            </button> &nbsp;
                                        </div>
                                        <div class="col-md-3"> 
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="HojaVida(per_codigo)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  Hoja de Vida</i>
                                            </button> &nbsp;
                                        </div> -->
                                        <!-- <div class="col-md-3">
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="CurrResumen(per_codigo)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  Curriculum Resumen</i>
                                            </button> &nbsp;
                                        </div>
                                        <div class="col-md-3">
                                            <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="CertTrabajo(per_codigo)" style="width: 100%;">
                                                <i class="far fa-file-alt" aria-hidden="true">  Certificado de Trabajo</i>
                                            </button> &nbsp;
                                        </div> -->
                                    </div>

                                    <!-- FILA 5 -->
                                    <div class="row p-2 bd-highlight justify-content-center">
                                        <div class="col-md-4">  
                                            <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras()">
                                                <i class="fas fa-reply" aria-hidden="true"> Volver Atrás</i>
                                            </button> &nbsp;
                                        </div>
                                    </div>

                                </div>
                                
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
            arrayDatosColegio : [],
            // arrayPersonalEspecialidades : [],
            
            // arrayEspecialidad : [],
            // arraySubespecialidad : [],

            // errorEspecialidadActualizar : 0,
            // errorMostrarMsjEspecialidadActualizar : [],

            // ano_actual : '',
            // per_cmi : '',
            // per_cmil : '',
            //VARIABLES MODAL
            // per_paterno : '',
            // per_materno : '',
            // per_nombre : '',
            //VARIABLES REGISTRAR PER_ESPECIALIDAD
            // perespe_nrodoc : '',
            // perespe_tipodoc : '',
            // perespe_fechadoc : '',
            // perespe_especialidad : '',
            // perespe_subespecialidad : '',
            // perespe_observacion : '',
            //VARIABLES EDITAR PER_ESPECIALIDAD
            // idPersonalEspecialidad : 0,
            // perespe_nrodocA : '',
            // perespe_tipodocA : '',
            // perespe_fechadocA : '',
            // perespe_especialidadA : '',
            // perespe_subespecialidadA : '',
            // perespe_observacionA : '',
            // rowId : 0,
        }
    },

    validations:{
            // perespe_nrodoc : { required },
            // perespe_tipodoc : { required },
            // perespe_fechadoc : { required },
            // perespe_especialidad : { required },
            // perespe_subespecialidad : { required },

            // perespe_nrodocA : { required },
            // perespe_tipodocA : { required },
            // perespe_fechadocA : { required },
            // perespe_especialidadA : { required },
            // perespe_subespecialidadA : { required },

            // validationGroupReg: ['perespe_nrodoc', 'perespe_tipodoc', 'perespe_fechadoc', 'perespe_especialidad', 'perespe_subespecialidad'],
            // validationGroupEdit: ['perespe_nrodocA', 'perespe_tipodocA', 'perespe_fechadocA', 'perespe_especialidadA', 'perespe_subespecialidadA']
    },

    mounted() {
        //this.ver();
        // this.listarPersonalEspecialidades(this.per_codigo);
        this.datosColegio(this.col_id);
    },
    methods: {

        // listarPersonalEspecialidades(per_codigo){
        //     let me = this;
        //     axios
        //   .post("/listarPersonalEspecialidad", {
        //     per_codigo : per_codigo,
        //   })
        //   .then(function (response) {
        //     console.log(response)
        //    me.arrayPersonalEspecialidades = response.data.especialidad.data
        //   })
        //   .catch(function (error) {
        //     // handle error
        //     console.log(error);
        //   })
        // },

        datosColegio(col_id){
            let me = this;
            axios
          .post("/datosColegio", {
            col_id : col_id,
          })
          .then(function (response) {
            console.log(response)
            me.arrayDatosColegio = response.data.colegio
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        // changeItem1: function changeItem1(rowId, event) {
        //     this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
        //     this.selectbuscarSubespecialidad(event.target.value);
        // },
        
        // selectEspecialidad(){
        //     let me =this;
        //     var filtro = me.arrayDatosPersonal.subescid;
        //     var url='/especialidad/selectEspecialidad?filtro='+ filtro;
        //     axios.get(url).then(function (response) {

        //         var respuesta = response.data;
        //         me.arrayEspecialidad = respuesta.especialidad; 
        //     })
        //     .catch(function (error) {
        //     // handle error
        //     console.log(error);
        //     })
        //     .then(function () {
        //     // always executed
        //     });
        // },

        // selectSubespecialidad(){
        //     let me =this;
        //     var url='/subespecialidad/selectSubespecialidad';
        //     axios.get(url).then(function (response) {

        //         var respuesta = response.data;
        //         me.arraySubespecialidad = respuesta.subespecialidad; 
        //     })
        //     .catch(function (error) {
        //     // handle error
        //     console.log(error);
        //     })
        //     .then(function () {
        //     // always executed
        //     });
        // },

        // selectbuscarSubespecialidad(depa)
        // {
        //     let me =this;
           
        //     me.buscarD= depa;
        //     me.arraySubespecialidad=[];
        //   //  me.prov_codigo=0;
        //     var url='/subespecialidad/selectbuscarSubespecialidad?buscar=' + depa;
        //     me.selected = url;
        //     axios.get(url).then(function (response) {

        //         var respuesta = response.data;
        //         me.arraySubespecialidad = respuesta.subespecialidad; 
                
        //     })
        //     .catch(function (error) {
        //     // handle error 
        //     me.selected =error;
        //     console.log(error);
        //     })
        //     .then(function () {
        //     // always executed
        //     }); 
        // },

        Cerrar(){
            this.$v.$reset()
        },

        // NuevaEspecialidad(){
        //     this.$v.$reset(),
        //     //PONER DE CERO EL MODAL ANTES DE REGISTRAR
        //     this.idPersonalEspecialidad = 0,
        //     this.perespe_nrodoc = '',
        //     this.perespe_tipodoc = '',
        //     this.perespe_fechadoc = '',
        //     this.perespe_especialidad = '',
        //     this.perespe_subespecialidad = '',
        //     this.perespe_observacion = '',
        //     //FIN PONER A CERO MODAL
        //     $('#NuevaEspecialidad').modal('show');
        //     $(".modal-header").css("background-color", "#007bff");
        //     $(".modal-header").css("color", "white" );
        //     $(".modal-title-registro").text("Registrar Nueva Especialidad");
        //     this.selectEspecialidad()
        //     this.selectSubespecialidad()
        //     this.selectbuscarSubespecialidad(this.perespe_especialidad)
        // },

        // RegistrarEspecialidad(){
        //     this.$v.$reset();
        //     if(!this.$v.validationGroupReg.$invalid){
        //         swal.fire({
        //             title: 'Se registrara la Especialidad', // TITULO 
        //             icon: 'warning', //ICONO (success, warnning, error, info, question)
        //             showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
        //             confirmButtonColor: '#3085d6', // COLOR DEL BOTON PARA CONFIRMAR
        //             cancelButtonColor: '#d33', // CLOR DEL BOTON CANCELAR
        //             confirmButtonText: 'Registrar', //TITULO DEL BOTON CONFIRMAR
        //             cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
        //             buttonsStyling: true,
        //             reverseButtons: true
        //             }).then((result) => {
        //             if (result.value) {
        //                 //CODIGO HA SER VALIDADO
        //                 let me = this;
        //                 axios
        //                 .post("/registrarPerEspecialidad", {
        //                 //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
        //                     per_codigo : me.per_codigo,
        //                     espe_cod : me.perespe_especialidad,
        //                     subespe_cod : me.perespe_subespecialidad,
        //                     documento : me.perespe_tipodoc,
        //                     fecha_documento : me.perespe_fechadoc,
        //                     fecha : me.perespe_fechadoc,
        //                     nrodoc : me.perespe_nrodoc,
        //                     observacion : me.perespe_observacion,
        //                     filtro : me.arrayDatosPersonal.subescid
        //                 })
        //                 .then(function (response) {
        //                     //Respuesta de la peticion
        //                     console.log(response);
        //                     Swal.fire({
        //                         icon    :   'success',
        //                         title   :   'Se ha registrado la nueva Especialidad',
        //                         showConfirmButton   : false,
        //                         timer   :   1500
        //                     })
        //                     $('#NuevaEspecialidad').modal('hide');
        //                     me.listarPersonalEspecialidades(me.per_codigo);
        //                 })
        //                 .catch(function (error) {
        //                     // handle error
        //                     console.log(error);
        //                 });
        //             }else{
        //                 console.log('no empezamos');
        //             }
        //         })  
        //     }else{
        //         this.$v.$touch();
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Ingrese todos los datos requeridos',
        //             showConfirmButton: false,
        //             timer: 2000
        //         })
                
        //     }
        // },

        // abrirEditar(personalEspecialidad){
        //     let me =this;
        //     this.$v.$reset(),
        //     this.idPersonalEspecialidad = personalEspecialidad.idpersonal_especialidades,
        //     this.perespe_nrodocA = personalEspecialidad.nrodoc, 
        //     this.perespe_tipodocA   = personalEspecialidad.documento,
        //     this.perespe_fechadocA = personalEspecialidad.fecha_documento,
        //     this.perespe_fechadocA = this.perespe_fechadocA.substring(0,10);
        //                                 var info10 = this.perespe_fechadocA.split('-');
        //                                 this.perespe_fechadocA = info10[0] + '-' + info10[1] + '-' + info10[2];
        //     this.perespe_especialidadA = personalEspecialidad.idespe,
        //     this.perespe_subespecialidadA = personalEspecialidad.idsubespe,
        //     this.perespe_observacionA = personalEspecialidad.observacion,
        //     $('#EditarEspecialidad').modal('show');
        //     $(".modal-header").css("background-color", "#007bff");
        //     $(".modal-header").css("color", "white" );
        //     $(".modal-title-edit").text("Editar Especialidad");
        //     this.selectEspecialidad()
        //     this.selectSubespecialidad()
        //     this.selectbuscarSubespecialidad(this.perespe_especialidadA)
        // },

        // // validarEspecialidadActualizar(){
        // //     this.errorEspecialidadActualizar=0;
        // //     this.errorMostrarMsjEspecialidadActualizar =[];
        // //     if(!this.perespe_nrodocA) this.errorMostrarMsjEspecialidadActualizar.push("Ingresar Nro de Documento");
        // //     if(!this.perespe_tipodocA) this.errorMostrarMsjEspecialidadActualizar.push("Seleccione tipo de Documento");
        // //     if(!this.perespe_fechadocA) this.errorMostrarMsjEspecialidadActualizar.push("Registre la Fecha del Documento");
        // //     if(!this.perespe_especialidadA) this.errorMostrarMsjEspecialidadActualizar.push("Seleccione una Especialidad");
        // //     if(!this.perespe_subespecialidadA) this.errorMostrarMsjEspecialidadActualizar.push("Seleccione una Subespecialidad");  
        // //     if
        // //     (this.errorMostrarMsjEspecialidadActualizar.length) this.errorEspecialidadActualizar = 1;
        // //     return this.errorEspecialidadActualizar;
        // // },

        // EditarEspecialidad(){
        //     this.$v.$reset();
        //     if(!this.$v.validationGroupEdit.$invalid){
        //         swal.fire({
        //             title: 'Se modificara esta Especialidad', // TITULO 
        //             icon: 'warning', //ICONO (success, warnning, error, info, question)
        //             showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
        //             confirmButtonColor: '#3085d6', // COLOR DEL BOTON PARA CONFIRMAR
        //             cancelButtonColor: '#d33', // CLOR DEL BOTON CANCELAR
        //             confirmButtonText: 'Actualizar', //TITULO DEL BOTON CONFIRMAR
        //             cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
        //             buttonsStyling: true,
        //             reverseButtons: true
        //             }).then((result) => {
        //             if (result.value) {
        //                 //CODIGO HA SER VALIDADO
        //                 let me = this;
        //                 axios
        //                 .put("/editarPerEspecialidad", {
        //             //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
        //                 id : me.idPersonalEspecialidad,
        //                 per_codigo : me.per_codigo,
        //                 espe_cod : me.perespe_especialidadA,
        //                 subespe_cod : me.perespe_subespecialidadA,
        //                 documento : me.perespe_tipodocA,
        //                 fecha_documento : me.perespe_fechadocA,
        //                 nrodoc : me.perespe_nrodocA,
        //                 observacion : me.perespe_observacionA,
        //             })                                                                                                                                                                                            
        //             .then(function (response) {
        //                 //Respuesta de la peticion
        //                 console.log(response);
        //                 Swal.fire({
        //                         icon    :   'success',
        //                         title   :   'Se ha actualizado la Especialidad',
        //                         showConfirmButton   : false,
        //                         timer   :   1500
        //                     })
        //                 $('#EditarEspecialidad').modal('hide');
        //                 me.listarPersonalEspecialidades(me.per_codigo);
        //             })
        //             .catch(function (error) {
        //                 // handle error
        //                 console.log(error);
        //                 });
        //             }else{
        //                 console.log('no empezamos');
        //             }
        //         })  
        //     }else{
        //         this.$v.$touch();
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Ingrese todos los datos requeridos',
        //             showConfirmButton: false,
        //             timer: 2000
        //         })
                
        //     }
        // },

        // desactivarPerEspecialidad(personalEspecialidad){
        //     //if(!this.$v.$invalid){
        //         swal.fire({
        //             title: 'Esta seguro de eliminar esta especialidad', // TITULO 
        //             icon: 'warning', //ICONO (success, warnning, error, info, question)
        //             showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
        //             confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
        //             cancelButtonColor: '#868077', // CLOR DEL BOTON CANCELAR
        //             confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
        //             cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
        //             buttonsStyling: true,
        //             reverseButtons: true
        //             }).then((result) => {
        //             if (result.value) {
        //                 //CODIGO HA SER VALIDADO
        //                 let me =this;
        //                 this.idPersonalEspecialidad = personalEspecialidad.idpersonal_especialidades,
        //                 this.perespe_fechadoc = personalEspecialidad.fecha_documento,
        //                 axios
        //                 .put('/desactivarPerEspecialidad', {
        //             //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
        //                 idPersonalEspecialidad : me.idPersonalEspecialidad,
        //                 fecha_documento : me.perespe_fechadoc,
        //                 per_codigo : me.per_codigo,
        //             })
        //             .then(function (response) {
        //                 //Respuesta de la peticion
        //                 console.log(response);
        //                 me.listarPersonalEspecialidades(me.per_codigo);
        //             })
        //             .catch(function (error) {
        //                 // handle error
        //                 console.log(error);
        //                 });
        //             }else{
        //                 console.log('no empezamos');
        //             }
        //         })  
        // },

        CurrComanjefe(per_codigo){
            window.open('http://127.0.0.1:8000/curriculumComanjefe?per_codigo='+per_codigo);
            // window.open('http://sipefab.fab.bo/curriculumComanjefe?per_codigo='+per_codigo);
        },

        CurrExtendido(per_codigo){
            window.open('http://127.0.0.1:8000/curriculumExtendido?per_codigo='+per_codigo);
            // window.open('http://sipefab.fab.bo/curriculumExtendido?per_codigo='+per_codigo);
        },

        CurrResumen(per_codigo){
            window.open('http://127.0.0.1:8000/curriculumResumen?per_codigo='+per_codigo);
            // window.open('http://sipefab.fab.bo/curriculumResumen?per_codigo='+per_codigo);
        },

        CertTrabajo(per_codigo){
            window.open('http://127.0.0.1:8000/certificadoTrabajo?per_codigo='+per_codigo);
            // window.open('http://sipefab.fab.bo/certificadoTrabajo?per_codigo='+per_codigo);
        },

        CurrVitae(per_codigo){
            window.open('http://127.0.0.1:8000/curriculumVitae?per_codigo='+per_codigo);
            // window.open('http://sipefab.fab.bo/certificadoTrabajo?per_codigo='+per_codigo);
        },

        HojaVida(per_codigo){
            window.open('http://127.0.0.1:8000/hojaVida?per_codigo='+per_codigo);
            // window.open('http://sipefab.fab.bo/certificadoTrabajo?per_codigo='+per_codigo);
        },

        

        Atras(){
            this.$router.push({
                name: "Colegios"
                //ENVIO DE DATOS
                // params:{
                //     d: datos
                // }
                
            });
        },

        EnvioDatos(datos){
            this.$router.push({
                name: "ListarEstudiantes",
                //ENVIO DE DATOS
                params:{
                    d: datos
                } 
            });
        },
        
        EnvioDatosCurso(datos){
            this.$router.push({
                name: "ListarCursos",
                //ENVIO DE DATOS
                params:{
                    d: datos
                } 
            });
        },

        EnvioDatosAsignacion(datos){
            this.$router.push({
                name: "ListarMaterias",
                //ENVIO DE DATOS
                params:{
                    d: datos
                } 
            });
        },



    },
}
</script>