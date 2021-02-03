import Vue from 'vue'
import VueRouter from 'vue-router'
// import store from './store'
import Home from './components/pages/TheHome'
import Login from './components/pages/TheLogin'
import Registration from './components/pages/Registration'
import Navigation from './components/pages/TheNavBar'


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
            path: '/registration',
            name: 'registration',
            component: Registration
        },
        {
            path: '/home',
            name: 'home',
            components: {
                default: Home,
                nav: Navigation
            }
        }
    ]
})

export default router