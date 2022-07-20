import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router ({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
       /* {
            path: '*',
            component: require('./components/Notfound.vue').default
        },
        {
            path: '/',
            component: require('./components/Content.vue').default
        },
        
        
        {
            path: '/personal',
            name: 'Personal',
            component: require('./components/Personal.vue').default
        },*/

        {
            path: '/listarColegios',
            name: 'Colegios',
            component: require('./components/Colegio.vue').default
        },

        {
            path: '/listarEstudiantes/:d',
            name: 'ListarEstudiantes',
            component: require('./components/Estudiante.vue').default
        },

        {
            path: '/listarCursos/:d',
            name: 'ListarCursos',
            component: require('./components/Curso.vue').default
        },

        {
            path: '/listarMaterias/:d',
            name: 'ListarMaterias',
            component: require('./components/Materia.vue').default
        },

        {
            path: '/designarEstudiantes',
            component: require('./components/DesignacionCurso.vue').default
        },

        {
            path: '/opcionColegio/:d',
            name: 'OpcionColegios',
            component: require('./components/OpcionColegios.vue').default
        },

        {
            path: '/destinosPersonal/:d',
            //name: "nombre_component"
            name: 'DestinosPersonal',
            component: require('./components/DestinosPersonal.vue').default
        },
        /*{
            path: '/modal/:d',
            //name: "nombre_component"
            name: 'Modal',
            component: require('./components/Modal.vue').default
        }*/
    ]
})