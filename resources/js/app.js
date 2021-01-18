import Vue from 'vue';
import router from './router.js'
import MainApp from './components/MainApp.vue'
import User from './helpers/User'
import vuetify from './vuetify'

require('./bootstrap');

window.User = User;
window.EventBus = new Vue();

const app = new Vue({
    el: '#app',
    components: {
        MainApp
    },
    vuetify,
    router
});
