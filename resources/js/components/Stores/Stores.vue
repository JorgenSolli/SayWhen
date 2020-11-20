<template>
    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="sm:col-span-5">
            <label class="block text-sm font-medium text-gray-700">
              Select store
            </label>
            <multiselect
                v-model="store"
                :options="stores"
                track-by="id"
                label="name"
                placeholder="Select a store"
            />
        </div>
        <div class="sm:col-span-1 mt-auto">
            <router-link
                :disabled="!store"
                :class="{'disabled': !store}"
                class="flex items-center px-4 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                :to="`/store/${storeId}`"
            >
                Continue
                <svg class="ml-auto -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </router-link>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    data() {
        return {
            stores: [],
            store: null,
            loding: true,
        }
    },
    components: {
        Multiselect
    },
    mounted() {
        this.fetchStores()
    },
    computed: {
        storeId() {
            if (this.store) {
                return this.store.id
            }

            return ''
        }
    },
    methods: {
        fetchStores() {
            axios
                .get('/api/stores')
                .then(({ data }) => {
                    this.stores = data.stores
                    this.loading = false
                })
        }
    }
}
</script>
