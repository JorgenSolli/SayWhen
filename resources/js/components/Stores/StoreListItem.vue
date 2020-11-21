<template>
    <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
        <div class="flex-1 flex flex-col p-8">
            <div class="h-16">
                <img class="flex-shrink-0 mx-auto" :src="store.logo" :alt="`${store.name} logo`">
            </div>
            <h3 class="mt-6 text-gray-900 text-sm font-medium" v-text="store.name"/>
        </div>
        <div>
            <div class="-mt-px flex divide-x divide-gray-200">
                <div class="w-0 flex-1 flex">
                    <a :href="store.url" target="_blank" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span class="ml-3">View Store</span>
                    </a>
                </div>
                <div class="-ml-px w-0 flex-1 flex">
                    <router-link
                        class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500"
                        :to="`/store/${store.id}`"
                    >
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                        <span class="ml-3">Continue</span>
                    </router-link>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
export default {
    props: {
        store: {
            required: true,
            type: Object
        }
    }
}
</script>
