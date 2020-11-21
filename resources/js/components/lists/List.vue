<template>
    <div>
        <portal to="page-title">
			Watchlist
		</portal>
    
        <div v-if="loggedIn">
            <div class="overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <product v-for="product in products" :key="product.id" :product="product" @deleted="deleted"/>
                </ul>
            </div>
        </div>
        <div v-else>
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Enter your email to view your watch-list
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 max-w">
                    The email will be remembered by the browser
                </p>
            </div>

            <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="py-8 px-4 sm:px-10">
                    <form class="space-y-6" action="#" method="POST">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1">
                                <input id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View list
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Product from '@/components/lists/Product'

export default {
    data() {
        return {
            email: null,
            products: [],
        }
    },
    components: {
        Product
    },
    mounted() {
        if (this.loggedIn) {
            this.fetch()
        }
    },
    computed: {
        loggedIn() {
            return StorageService.get('email')
        }
    },
    methods: {
        login() {
            StorageService.set('email', this.email)
            this.fetch()
        },
        fetch() {
            axios
                .get('/api/products/list', {
                    params: {
                        email: StorageService.get('email')
                    }
                })
                .then(({ data }) => {
                    this.products = data.products
                })
        },
        deleted() {
            
        }
    }
}
</script>
