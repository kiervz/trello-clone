import Vue from 'vue'
import VueRouter from 'vue-router'
import Test from './components/Test.vue'
import Login from './components/auth/login.vue'
import Register from './components/auth/register.vue'

Vue.use(VueRouter);

const routes = [
    {
        path: '/test',
        component: Test
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});
