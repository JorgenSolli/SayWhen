<template>
	<div class="flex flex-col h-screen justify-between min-h-screen bg-gray-100">
		<div>
			<div class="bg-green-400 pb-32">
				<nav class="bg-green-400 border-b border-green-300 border-opacity-25 lg:border-none">
					<div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
						<div class="relative h-16 flex items-center justify-between lg:border-b lg:border-green-400 lg:border-opacity-25">
							<div class="flex items-center justify-between h-16 px-4 sm:px-0">
								<div class="flex items-center">
									<div class="flex-shrink-0">
										<router-link to="/">
											<svg
												class="logo text-white h-8 w-8"
												xmlns="http://www.w3.org/2000/svg"
												fill="none"
												viewBox="0 0 24 24"
												stroke="currentColor"
											>
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
											</svg>
										</router-link>
									</div>

									<div class="md:block">
										<div class="ml-10 flex items-baseline space-x-4">
											<router-link :to="'/store'" class="block px-3 py-2 rounded-md text-base font-medium text-white">
												Store
											</router-link>

											<router-link :to="'/my-list'" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-green-700">
												My list
											</router-link>
										</div>
									</div>
								</div>
							</div>

							<div v-if="$store.state.email" class="lg:block lg:ml-4">
								<div class="flex items-center">
									<div class="ml-3 relative flex-shrink-0">
										<router-link
											to="/account"
											class="bg-indigo-600 rounded-full flex text-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white"
											aria-haspopup="true"
										>
											<img class="rounded-full h-8 w-8" :src="avatar" alt="avatar">
										</router-link>
									</div>
								</div>
							</div>
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

		<footer class="bg-white">
			<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
				<div class="flex justify-center space-x-6 md:order-2">
					<a href="https://github.com/JorgenSolli/SayWhen" class="text-gray-400 hover:text-gray-500">
						<span class="sr-only">GitHub</span>
						<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
						</svg>
					</a>
				</div>

				<div class="mt-8 md:mt-0 md:order-1">
					<p class="text-center text-base text-gray-400">
						SayWhen - Created by <a href="https://github.com/JorgenSolli">Jørgen Solli</a>
					</p>
				</div>
			</div>
		</footer>
	</div>
</template>

<script>
import md5 from 'md5'

export default {
	computed: {
		avatar() {
			if (!this.$store.state.email) {
				return null
			}

			const img = [
				`https://www.gravatar.com/avatar/`,
				md5(this.$store.state.email.trim().toLowerCase()),
				`?s=200`,
				`&r=g`
			]

			return img.join('');
		}
	}
};
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
