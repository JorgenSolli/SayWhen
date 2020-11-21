<template>
    <li>
        <div class="block">
            <div class="block md:flex items-center px-4 py-4 sm:px-6">
                <div class="block md:flex-1 md:flex min-w-0 items-center">
                    <div class="flex-shrink-0">
                        <img
                            class="w-32 md:w-24 mb-2 md:mb-0"
                            :src="product.store.logo"
                            :alt="product.store.name"
                        />
                    </div>
                    <div class="min-w-0 flex-1 px-0 md:px-4 md:grid md:grid-cols-2 md:gap-4">
                        <div>
                            <p class="text-md md:text-sm font-medium text-indigo-600 truncate capitalize" v-html="product.product_name"/>
                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                <span class="truncate">
                                    Product added {{ product.created_at }}
                                </span>
                            </p>
                        </div>
                        <div class="mt-4 flex-shrink-0 sm:mt-0">
                            <p class="text-sm text-gray-900">
                                Last scanned
                                <time datetime="2020-01-07" v-text="product.last_scan"/>
                            </p>
                            <p
                                class="mt-2 flex items-center text-sm text-gray-500"
                            >
                                <svg
                                    :class="product.found ? 'text-green-400' : 'text-yellow-400'"
                                    class="flex-shrink-0 mr-1.5 h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                {{ product.stock_status }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-auto mt-2 md:mt-0">
                    <a
                        v-if="product.product_url"
                        :href="product.product_url"
                        target="_blank"
                        class="pr-4 mb-2 inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <svg class="-ml-0.5 mr-3 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                            />
                        </svg>
                        Buy
                    </a>

                    <div class="inline-block md:block">
                        <refresh-product :product="product" @fetch="$emit('fetch')"/>
                        <delete-product :product="product" @fetch="$emit('fetch')"/>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
import DeleteProduct from '@/components/Products/DeleteProduct'
import RefreshProduct from '@/components/Products/RefreshProduct'

export default {
    components: {
        DeleteProduct,
        RefreshProduct
    },
    props: {
        product: {
            type: Object,
            required: true,
        }
    }
};
</script>
