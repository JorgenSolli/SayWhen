<template>
    <div>
        <button
            @click="check"
            type="button"
            class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
        >
            <svg
                class="h-5 w-5 text-gray-400"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"
                />
            </svg>
            <span>Check</span>
        </button>
        <product-modal :product="product" :is-open="productModal" @closed="productModal = false"/>
    </div>
</template>

<script>
import ProductModal from '@/components/Products/ProductModal'

export default {
    data() {
        return {
            productModal: false,
            product: {}
        }
    },
    props: {
        name: String
    },
    components: {
        ProductModal
    },
    methods: {
        check() {
            axios
                .get(`/api/stores/store/${this.$route.params.store}/lookup`, {
                    params: {
                        product: this.name
                    }
                })
                .then(({ data }) => {
                    this.product = data.product
                    this.productModal = true
                })
        }
    }
}
</script>
