import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        component: require('@/components/LandingPage.vue').default,
    },
    {
        path: '/about',
        component: require('@/components/LandingPage.vue').default,
    },
    {
        path: '/store',
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
    {
        path: '/account',
        component: require('@/components/User/Account.vue').default,
    },
    {
        path: '/email/verify',
        component: require('@/components/User/VerifyEmail.vue').default,
    },
]

const router = new VueRouter({
    linkExactActiveClass: 'bg-green-800',
    mode: 'history',
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                selector: to.hash,
                behavior: 'smooth',
            }
        }
    }
})

export default router
