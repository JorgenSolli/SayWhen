<template>
	<div class="min-h-screen bg-gray-100">
        <div class="bg-green-400 pb-32">
            <nav class="bg-green-400 border-b border-green-300 border-opacity-25 lg:border-none">
				<div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                    <div class="relative h-16 flex items-center justify-between lg:border-b lg:border-green-400 lg:border-opacity-25">
						<div
							class="flex items-center justify-between h-16 px-4 sm:px-0"
						>
							<div class="flex items-center">
								<div class="flex-shrink-0">
									<svg
										class="logo text-white h-8 w-8"
										xmlns="http://www.w3.org/2000/svg"
										fill="none"
										viewBox="0 0 24 24"
										stroke="currentColor"
									>
  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
									</svg>
								</div>

								<div class="hidden md:block">
									<div class="ml-10 flex items-baseline space-x-4">
										<router-link :to="'/'" class="block px-3 py-2 rounded-md text-base font-medium text-white">
                                            SayWhen
                                        </router-link>

                                        <router-link :to="'/my-list'" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-green-700">
                                            My list
                                        </router-link>
									</div>
								</div>
							</div>

							<div class="-mr-2 flex md:hidden">
								<!-- Mobile menu button -->
								<button
									class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
								>
									<span class="sr-only">Open main menu</span>
									<!--
                                        Heroicon name: menu
                                        Menu open: "hidden", Menu closed: "block"
                                    -->
									<svg
										class="block h-6 w-6"
										xmlns="http://www.w3.org/2000/svg"
										fill="none"
										viewBox="0 0 24 24"
										stroke="currentColor"
										aria-hidden="true"
									>
										<path
											stroke-linecap="round"
											stroke-linejoin="round"
											stroke-width="2"
											d="M4 6h16M4 12h16M4 18h16"
										/>
									</svg>
									<!--
                                        Heroicon name: x
                                        Menu open: "block", Menu closed: "hidden"
                                    -->
									<svg
										class="hidden h-6 w-6"
										xmlns="http://www.w3.org/2000/svg"
										fill="none"
										viewBox="0 0 24 24"
										stroke="currentColor"
										aria-hidden="true"
									>
										<path
											stroke-linecap="round"
											stroke-linejoin="round"
											stroke-width="2"
											d="M6 18L18 6M6 6l12 12"
										/>
									</svg>
								</button>
							</div>
						</div>
					</div>
				</div>

				<!--
                    Mobile menu, toggle classes based on menu state.
                    Open: "block", closed: "hidden"
                -->
				<div class="hidden border-b border-gray-700 md:hidden">
					<div class="px-2 py-3 space-y-1 sm:px-3">
                        <router-link :to="'/'" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-green-700">
                            <img class="logo" src="assets/images/logo.png" />
                            SayWhen
                        </router-link>

                        <router-link :to="'/my-list'" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-green-700">
                            My list
                        </router-link>
					</div>
				</div>
			</nav>
			<header class="py-10">
				<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
					<h1 class="text-3xl font-bold text-white">
						<portal-target name="page-title"/>
					</h1>
				</div>
			</header>
		</div>

		<main class="-mt-32">
			<div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6">
                    <transition name="fade" mode="out-in">
                        <router-view />
                    </transition>
                </div>
			</div>
		</main>
	</div>
</template>

<script>
export default {};
</script>


<style>
    .cls-1 {
        fill:#111827;
        isolation:isolate;
    }

    .cls-2 {
        fill:#fff;
    }
</style>
