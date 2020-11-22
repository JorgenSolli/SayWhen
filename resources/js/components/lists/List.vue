<template>
    <div>
        <portal to="page-title">
			Watchlist
		</portal>
    
        <div v-if="$store.state.email">
            <send-email-verification v-if="!email_verified"/>

            <div class="overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <product v-for="product in products" :key="product.id" :product="product" @fetch="fetch"/>
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
                    <form @submit.prevent="logIn" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1">
                                <input v-model="email" id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
import SendEmailVerification from '@/components/User/SendEmailVerification'

export default {
    data() {
        return {
            email: null,
            products: [],
            email_verified: true,
        }
    },
    components: {
        Product,
        SendEmailVerification
    },
    mounted() {
        if (this.$store.state.email) {
            this.email = StorageService.get('email')
            this.fetch()
        }
    },
    methods: {
        logIn() {
            StorageService.set('email', this.email)
            this.$store.commit('set', this.email)
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
                    this.email_verified = data.email_verified
                })
        },
    }
}
</script>
