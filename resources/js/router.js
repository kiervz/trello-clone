import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './components/pages/Home.vue'
import Login from './components/auth/login.vue'
import Register from './components/auth/register.vue'
import Logout from './components/auth/logout.vue'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
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


const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        if (User.loggedIn()) {
            next()
        } else {
            next({ path: '/login' })
        }
    }
    next()
})

export default router
