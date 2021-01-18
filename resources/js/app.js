import Vue from 'vue';
import router from './router.js'
import MainApp from './components/MainApp.vue'

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        MainApp
    },
    router
});
