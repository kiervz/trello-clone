import Vue from 'vue';
import router from './router.js'
import MainApp from './components/MainApp.vue'
import User from './helpers/User'
import vuetify from './vuetify'

require('./bootstrap');

window.User = User;
window.EventBus = new Vue();

// Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast

const app = new Vue({
    el: '#app',
    components: {
        MainApp
    },
    vuetify,
    router
});
