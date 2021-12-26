require('./bootstrap');
import vue from 'vue'
window.Vue = vue;

import App from './components/App.vue';

import VueAxios from 'vue-axios'
import axios from 'axios';

import VueRouter from 'vue-router';
import BootstrapSidebar from 'vue-bootstrap-sidebar'
import { routes } from './routes';
import Vue from 'vue';
import Swal from 'sweetalert2'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'



import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

window.Swal = Swal
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
  window.Toast = Toast
Vue.use(VueRouter);
Vue.use(VueAxios,axios);
Vue.use(BootstrapSidebar);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)




const router = new VueRouter({
    mode : 'history',
    routes : routes
});

const app = new Vue ({
    el: '#app',
    router: router,
    render: h => h(App)
});

