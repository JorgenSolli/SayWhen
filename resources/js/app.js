require('./bootstrap');

window.Vue = require('vue')

import PortalVue from 'portal-vue'
import Storage from './storage.js'
import VueSweetalert2 from 'vue-sweetalert2'
import Multiselect from 'vue-multiselect'
import Toasted from 'vue-toasted';
import router from './routes.js'
import VueRouter from 'vue-router'
import 'vue-multiselect/dist/vue-multiselect.min.css'

window.StorageService = new Storage()

Vue.use(PortalVue)
Vue.use(VueSweetalert2)
Vue.use(Multiselect)
Vue.use(VueRouter)
Vue.use(Toasted, {
    iconPack : 'custom-class',
    router
})

Vue.component('dju-hav-it', require('./components/App.vue').default)

const vm = new Vue({
    el: '#app',
    router,
    data() {
        return {    

        }
    },
    mounted() {
    },
    methods: {
        
    }
})
