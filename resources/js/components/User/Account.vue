<template>
    <div>
        <portal to="page-title">
			<span v-text="$store.state.email"/>
		</portal>

        <p>You are currently viewing the watchlist with the email {{ $store.state.email }}</p>
        <button
            @click="logOut"
            type="button"
            class="mt-2 inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                />
            </svg>
            This is not me
        </button>
    </div>
</template>

<script>
export default {
    methods: {
        logOut() {
            StorageService.remove('email')
            this.$store.commit('set', null)
            this.$router.push('/')
        }
    }
}
</script>
