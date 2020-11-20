<template>
    <li>
        <a :href="watcher.product_url" target="_blank" class="block hover:bg-gray-50">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="min-w-0 flex-1 flex items-center">
                    <div class="flex-shrink-0">
                        <img
                            class="h-12 w-24 rounded-full"
                            :src="watcher.store.logo"
                            :alt="watcher.store.name"
                        />
                    </div>
                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                        <div>
                            <p class="text-sm font-medium text-indigo-600 truncate" v-text="watcher.product_name"/>
                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                <span class="truncate">
                                    Last scanned: {{ watcher.last_scan }}
                                </span>
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div>
                                <p class="text-sm text-gray-900">
                                    Watcher added
                                    <time datetime="2020-01-07" v-text="watcher.created_at"/>
                                </p>
                                <p
                                    class="mt-2 flex items-center text-sm text-gray-500"
                                >
                                    <svg
                                        :class="watcher.found ? 'text-green-400' : 'text-yellow-400'"
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
                                    {{ watcher.stock_status }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <svg
                        class="h-5 w-5 text-gray-400"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
            </div>
        </a>
    </li>
</template>

<script>
export default {
    props: {
        watcher: {
            type: Object,
            required: true,
        }
    }
};
</script>
