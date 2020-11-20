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
    linkExactActiveClass: 'bg-gray-900',
    mode: 'history',
    routes
})

router.beforeEach((to, from , next) => {
    next()
})

export default router
