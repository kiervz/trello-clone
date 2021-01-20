import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue'
import Logout from './components/auth/Logout.vue'
import Task from './components/pages/Task/Task.vue'
import NotFound404 from './components/pages/NotFound404.vue'

Vue.use(VueRouter);

const routes = [
    {
        name: 'Login',
        path: '/login',
        component: Login
    },
    {
        name: 'Register',
        path: '/register',
        component: Register
    },
    {
        name: 'Task',
        path: '/task',
        component: Task,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'Logout',
        path: '/logout',
        component: Logout
    },
    {
        name: 'NotFound',
        path: '*',
        component: NotFound404
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
