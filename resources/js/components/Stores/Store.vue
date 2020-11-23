<template>
	<div>
		<portal to="page-title">
			Watch a product on <span class="capitalize">{{ $route.params.store }}</span>
		</portal>

		<form @submit.prevent="addProduct" class="space-y-8 divide-y divide-gray-200">
			<div class="space-y-8 divide-y divide-gray-200">
				<div>
					<div>
						<h3 class="text-lg leading-6 font-medium text-gray-900">
							Product
						</h3>
						<p class="mt-1 text-sm text-gray-500">
							Please be as specific as possible when entering the
							product name
						</p>
					</div>

					<div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
						<div class="sm:col-span-4">
							<label for="product_name" class="block text-sm font-medium text-gray-700">
								Product name
							</label>

							<div :class="{'relative': errors.product}" class="mt-1">
								<input
									:class="{'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500': errors.product}"
									id="product_name"
									type="text"
									v-model="product"
									required
									class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md sm:text-sm border-gray-300"
								/>

								<div v-if="errors.product" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
									<svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
									</svg>
								</div>
							</div>

							<div v-if="errors.product">
								<p class="mt-2 text-sm text-red-600" v-for="error in errors.product" :key="error" v-text="error"/>
							</div>
						</div>

						<div class="sm:col-span-4">
							<label for="product_nr" class="block text-sm font-medium text-gray-700">
								Product Number
							</label>
							<div class="mt-1">
								<input
									v-model="product_nr"
									id="product_nr"
									type="text"
									class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md sm:text-sm border-gray-300"
								>
							</div>

							<div class="rounded-md bg-blue-50 p-4 mt-4">
								<div class="flex">
									<div class="flex-shrink-0">
										<svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
										</svg>
									</div>

									<div class="ml-3 flex-1 md:flex md:justify-between">
										<p class="text-sm text-blue-700">
											You can optionally specify a product/item number to further improve the accuracy of SayWhen's search
										</p>
									</div>
								</div>
							</div>
						</div>

						<div class="sm:col-span-4">
							<check-product
								:name="product"
								:number="product_nr"
								@product-selected="productSelected"
							/>
						</div>
					</div>
				</div>

				<div class="pt-8">
					<div>
						<h3 class="text-lg leading-6 font-medium text-gray-900">
							Notification settings
						</h3>
						<p class="mt-1 text-sm text-gray-500">
							How would you like to be notified when the product is in stock?
						</p>
					</div>

					<div
						class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
					>
						<div class="sm:col-span-4">
							<label
								for="email"
								class="block text-sm font-medium text-gray-700"
							>
								Email address
							</label>
							<div :class="{'relative': errors.email}" class="mt-1">
								<input
									id="email"
									type="email"
									v-model="email"
									required
									:class="{'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500': errors.email}"
									class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
								/>

								<div v-if="errors.email" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
									<svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
									</svg>
								</div>
							</div>

							<div v-if="errors.email">
								<p class="mt-2 text-sm text-red-600" v-for="error in errors.email" :key="error" v-text="error"/>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="pt-5">
				<div class="flex justify-end">
					<router-link
						to="/store"
						type="button"
						class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
					>
						Go back
					</router-link>
					<button
						type="submit"
						class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
					>
						Watch this product
					</button>
				</div>
			</div>
		</form>

		<generic-modal
			v-if="productAdded"
			:success="success"
			:title="title"
			:content="message"
			:secondary-button="{
				title: 'Go to overview',
				action: '/my-list',
			}"
			@close="productAdded = false"
		/>
	</div>
</template>

<script>
import CheckProduct from '@/components/Stores/CheckProduct'
import GenericModal from '@/components/GenericModal'

export default {
	data() {
		return {
			product: null,
			product_nr: null,
			email: null,
			productAdded: false,
			title: null,
			success: null,
			message: null,
			errors: {},
		};
    },
    components: {
		CheckProduct,
		GenericModal
	},
	mounted() {
		this.email = StorageService.get('email')
	},
	methods: {
		addProduct() {
			axios
				.put(`/api/products/product/${this.$route.params.store}`, {
					product: this.product,
					product_nr: this.product_nr,
					email: this.email,
				})
				.then(({ data }) => {
                    if (data.success) {
						this.title = 'Cool!'
						StorageService.set('email', this.email)
						this.$store.commit('set', this.email)
						this.resetForm()
                    } else {
						this.title = 'Uh oh!'
					}

					this.productAdded = true
					this.success = data.success
					this.message = data.message
				})
				.catch(({ response }) => {
					if (response.data) {
						this.errors = response.data.errors
					}
				})
		},
		resetForm() {
			this.product = null
			this.product_nr = null
		},
		productSelected(product_nr) {
			this.product_nr = product_nr
		}
	},
};
</script>
