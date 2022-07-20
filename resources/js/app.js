/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Vue-Form-Wizard
 */
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)


/**
 * Vue2-DatePicker
 */

import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
Vue.use(DatePicker)

/**
 * VUE-MOMENT; formato de fechas
 */

Vue.use(require('vue-moment'))

/**
 * Vue Select para los droplist
 */

import Vue from 'vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect)

/**
 * Vue Vuelidate
 */

 import Vuelidate from 'vuelidate';
 Vue.use(Vuelidate)

/**
 * Vue Router
 */


import router from './routes'



Vue.component('App', require('./components/App.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    router
});
