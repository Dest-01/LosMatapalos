/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 import moment from 'moment';

//Importamos la librería y nuestros dos json
import VueI18n from 'vue-i18n';
import en from '../lang/en_US.json'
import es from '../lang/es_ES.json'


Vue.config.productionTip = false

//añadimos la libreria
Vue.use(VueI18n);
 
 import { Form, HasError, AlertError } from 'vform';
 window.Form = Form;
 
 import Gate from "./Gate";
 Vue.prototype.$gate = new Gate(window.user);
 
 import Swal from 'sweetalert2';
 
 /* Creamos una instancia de la librería i18n, le añadimos por defecto el idioma 'en' 
(puedes cambiarlo por 'es') y le indicamos qué json utilizar en cada idioma */
const i18n = new VueI18n({
    locale: 'en',
    messages: {
      en: {
        lang: en
      },
      es: {
        lang: es
      }
    }
  });
 
 const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000,
     timerProgressBar: true,
     onOpen: (toast) => {
       toast.addEventListener('mouseenter', Swal.stopTimer)
       toast.addEventListener('mouseleave', Swal.resumeTimer)
     }
   })
 window.Swal = Swal;
 window.Toast = Toast;
 
 import VueProgressBar from 'vue-progressbar'
 Vue.use(VueProgressBar, {
     color: 'rgb(143, 255, 199)',
     failedColor: 'red',
     height: '3px'
   });
 
 Vue.component(HasError.name, HasError)
 Vue.component(AlertError.name, AlertError)
 
 
 /**
  * Routes imports and assigning
  */
 import VueRouter from 'vue-router';
 Vue.use(VueRouter);
 import routes from './routes';
 
 const router = new VueRouter({
     mode: 'history',
     routes
 });
 // Routes End
 
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
  
 // Components
 Vue.component('pagination', require('laravel-vue-pagination'));
 Vue.component('dashboard', require('./components/Dashboard.vue'));
 
 Vue.component(
     'passport-clients',
     require('./components/passport/Clients.vue').default
 );
 
 Vue.component(
     'passport-authorized-clients',
     require('./components/passport/AuthorizedClients.vue').default
 );
 
 Vue.component(
     'passport-personal-access-tokens',
     require('./components/passport/PersonalAccessTokens.vue').default
 );
 
 Vue.component(
     'not-found',
     require('./components/NotFound.vue').default
 );
 
 // Filter Section
 
 Vue.filter('myDate',function(created){
     return moment(created).format('MMMM Do YYYY');
 });
 
 Vue.filter('yesno', value => (value ? '<i class="fas fa-check green"></i>' : '<i class="fas fa-times red"></i>'));
 
 // end Filter
 
 Vue.component('example-component', require('./components/ExampleComponent.vue'));
 
 const app = new Vue({
     el: '#app',
     router
 });