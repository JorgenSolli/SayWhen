import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        component: require('@/components/stores/Stores.vue').default,
    },
    {
        path: '/store/:store',
        component: require('@/components/stores/Store.vue').default,
    },
    {
        path: '/my-list',
        component: require('@/components/lists/List.vue').default,
    },
]

const router = new VueRouter({
    linkExactActiveClass: 'bg-green-800',
    mode: 'history',
    routes
})

export default router
