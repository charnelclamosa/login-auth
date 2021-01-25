import Vue from 'vue'
import VueRouter from 'vue-router'
// import store from './store'
import Home from './components/pages/TheHome'
import Login from './components/pages/TheLogin'


Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/login'
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        }
    ]
})

export default router