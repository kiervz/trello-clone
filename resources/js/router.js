import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './components/pages/Home.vue'
import Login from './components/auth/login.vue'
import Register from './components/auth/register.vue'
import Logout from './components/auth/logout.vue'

Vue.use(VueRouter);

const routes = [
    {
        path: '/home',
        component: Home
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/logout',
        component: Logout
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});
