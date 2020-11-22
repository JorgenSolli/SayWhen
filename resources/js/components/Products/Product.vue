<template>
    <div class="py-2">
        <div @click="selectProduct" class="py-2 cursor-pointer hover:bg-gray-50">
            <div class="flex items-center space-x-3">
                <h3 class="text-gray-900 text-sm font-medium truncate" v-html="product.title"/>
            </div>
            <p class="mt-1 text-gray-500 text-sm truncate" v-text="product.sub_title"/>
            <p
                v-if="product.stock"
                :class="product.has_stock ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                class="flex-shrink-0 inline-block px-2 py-0.5 text-xs font-medium rounded-full"
                v-text="product.stock"
            />
            <p
                v-else
                class="bg-red-100 text-red-800 flex-shrink-0 inline-block px-2 py-0.5 text-xs font-medium rounded-full"
            >
                Looks like it's out of stock
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product: {
            required: true,
            type: Object
        }
    },
    methods: {
        selectProduct() {
            this.$emit('product-selected', this.product.product_number)
        }
    }
}
</script>
