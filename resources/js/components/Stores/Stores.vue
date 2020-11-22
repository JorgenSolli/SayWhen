<template>
    <div class="sm:col-span-5">
        <portal to="page-title">
            Select a store
        </portal>

        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <store-list-item v-for="store in stores" :store="store" :key="store.id"/>
        </ul>
    </div>
</template>

<script>
import StoreListItem from '@/components/Stores/StoreListItem'

export default {
    data() {
        return {
            stores: [],
            store: null,
            loding: true,
        }
    },
    components: {
        Multiselect,
        StoreListItem
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
