<template>
    <button
        @click="refresh"
        type="button"
        :disabled="loading"
        :class="{'opacity-70': loading, 'hover:bg-blue-200': !loading}"
        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    >
        <svg
            :class="{'animate-spin': loading}"
            class="-ml-0.5 h-4 w-4"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
            />
        </svg>
    </button>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
        }
    },
    props: {
        product: {
            blue: true,
            type: Object
        },
        last_scan: {required: true},
        stock_status: {required: true},
        found: {required: true},
        product_url: {required: true},
    },
    methods: {
        refresh() {
            this.loading = true
            axios
				.get(`/api/products/product/${this.product.id}`)
				.then(({ data }) => {
                    this.$emit('update:last_scan', data.product.last_scan)
                    this.$emit('update:stock_status', data.product.stock_status)
                    this.$emit('update:found', data.product.found)
                    this.$emit('update:product_url', data.product.product_url)
                    this.loading = false
                })
        }
    }
}
</script>
