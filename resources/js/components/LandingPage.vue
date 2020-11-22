<template>
    <div>
        <main class="mt-8 mx-auto max-w-7xl px-4">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Never miss out on</span>
                    <span class="block text-indigo-600 xl:inline">the cool stuff!</span>
                </h1>

                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Ever waited patiently for a product to release or come back in stock, only to find out you were too late and it's already sold out?
                    Then SayWhen is exactly what you need!
                </p>

                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <router-link to="/store" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                            Get started
                        </router-link>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <button
                            @click="$router.push('#learn-more')"
                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10"
                        >
                            Learn more
                        </button>
                    </div>
                </div>
            </div>
        </main>

        <div id="learn-more" class="relative mt-12 mb-8 lg:mt-24 lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
            <div class="relative">
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight sm:text-3xl">
                    Get instantly notified
                </h3>
                <p class="mt-3 text-lg text-gray-500">
                    Don't rely on the retailer's email notifications. More often than not, you will receive stock-update emails hours after the product
                    is in stock. This is because outgoing e-mail is very sensitive to the appearance of being bulk or spam.
                </p>

                <dl class="mt-10 space-y-10">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Nearly instant notification
                            </dt>
                            <dd class="mt-2 text-base text-gray-500">
                                SayWhen will check the stock status for your watchlist products every ten minutes and email you the second the state changes.
                            </dd>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Multiple stores supported
                            </dt>
                            <dd class="mt-2 text-base text-gray-500">
                                You can watch for a product on multiple trusted stores. Current stores supported are NetOnNet and Komplett
                            </dd>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>

                        <div class="ml-4">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                No account required
                            </dt>
                            <dd class="mt-2 text-base text-gray-500">
                                SayWhen does not implement user accounts. Your watchlist is simply associated with your email address.
                                All you need to do is verify your email in order to receive notifications
                            </dd>
                        </div>
                    </div>
                </dl>
            </div>

            <div class="mt-10 -mx-4 relative lg:mt-0" aria-hidden="true">
                <img class="mx-auto relative rounded-2xl shadow-2xl" width="490" src="/images/product_list.png" alt="List of products">
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>
