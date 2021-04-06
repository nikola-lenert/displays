import Vue from 'vue'
import VueRouter from 'vue-router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import store from './store/index'

import App from './App.vue'
import Displays from './views/displays/index'
import Homepage from './views/homepage/index'
import DisplayDetails from './views/displays/_/index'

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'homepage',
            component: Homepage
        },
        {
            path: '/displays',
            name: 'displays',
            component: Displays
        },
        {
            path: '/displays/:id',
            name: 'displays-id',
            component: DisplayDetails
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
