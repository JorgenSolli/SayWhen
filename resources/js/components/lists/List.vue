<template>
    <div v-if="loggedIn">
        Show list
    </div>
    <div v-else>
        <button class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline"></button>
        Enter email
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: null,
            list: [],
        }
    },
    mounted() {
        if (this.loggedIn) {
            this.fetch()
        }
    },
    computed: {
        loggedIn() {
            return StorageService.get('email')
        }
    },
    methods: {
        login() {
            StorageService.set('email', this.email)
            this.fetch()
        },
        fetch() {
            axios
                .get('watchers/list')
        }
    }
}
</script>
