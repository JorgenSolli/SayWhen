require('./bootstrap');

window.Vue = require('vue')

import PortalVue from 'portal-vue'
import Storage from './storage.js'
import router from './routes.js'
import VueRouter from 'vue-router'
import Vuex from 'vuex'


window.StorageService = new Storage()

Vue.use(Vuex)
Vue.use(PortalVue)
Vue.use(VueRouter)

Vue.component('say-when', require('./components/App.vue').default)

const store = new Vuex.Store({
    state: {
        email: StorageService.get('email')
    },
    mutations: {
        set(state, email) {
            state.email = email
        }
    }
})

const vm = new Vue({
    el: '#app',
    store,
    router,
})
