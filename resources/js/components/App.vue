<template>
	<div class="min-h-screen bg-gray-100">
        <div class="bg-indigo-600 pb-32">
            <nav class="bg-indigo-600 border-b border-indigo-300 border-opacity-25 lg:border-none">
				<div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                    <div class="relative h-16 flex items-center justify-between lg:border-b lg:border-indigo-400 lg:border-opacity-25">
						<div
							class="flex items-center justify-between h-16 px-4 sm:px-0"
						>
							<div class="flex items-center">
								<div class="flex-shrink-0">
                                    <svg class="logo h-8 w-8" data-name="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><defs></defs><path class="cls-1" d="M0,192V448a32,32,0,0,0,32,32H416a32,32,0,0,0,32-32V192ZM305.1,341.2l-72.6,71.4a12.2,12.2,0,0,1-17,0l-72.6-71.4a49.58,49.58,0,0,1,3.7-74.2c20.5-16.7,51.1-13.7,70,4.8l7.4,7.3,7.4-7.3c18.8-18.5,49.4-21.5,70-4.8a49.66,49.66,0,0,1,7.67,69.81,48.54,48.54,0,0,1-4,4.39Z"/><path class="cls-2" d="M301.4,267c-20.6-16.7-51.2-13.7-70,4.8l-7.4,7.3-7.4-7.3c-18.9-18.5-49.5-21.5-70-4.8a49.61,49.61,0,0,0-3.7,74.2l72.6,71.4a12.2,12.2,0,0,0,17,0l72.6-71.4a49.64,49.64,0,0,0-3.7-74.2ZM391.3,53.9A32,32,0,0,0,360.9,32H240V160H446.7c.4-.5.5-.7.9-1.2ZM208,32H87.1A32,32,0,0,0,56.7,53.9L.4,158.8c.4.5.5.7.9,1.2H208Z"/></svg>
								</div>

								<div class="hidden md:block">
									<div class="ml-10 flex items-baseline space-x-4">
										<router-link :to="'/'" class="block px-3 py-2 rounded-md text-base font-medium text-white">
                                            SayWhen
                                        </router-link>

                                        <router-link :to="'/my-list'" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-700">
                                            My list
                                        </router-link>
									</div>
								</div>
							</div>

							<div class="-mr-2 flex md:hidden">
								<!-- Mobile menu button -->
								<button
									class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
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
                        <router-link :to="'/'" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-700">
                            <img class="logo" src="assets/images/logo.png" />
                            SayWhen
                        </router-link>

                        <router-link :to="'/my-list'" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-700">
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
