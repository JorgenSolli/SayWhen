<template>
	<form @submit.prevent="watch" class="space-y-8 divide-y divide-gray-200">
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

				<div
					class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
				>
					<div class="sm:col-span-4">
						<label
							for="product_name"
							class="block text-sm font-medium text-gray-700"
						>
							Product name
						</label>

						<div class="mt-1 flex rounded-md shadow-sm">
							<div
								class="relative flex items-stretch flex-grow focus-within:z-10"
							>
								<input
									id="product_name"
									type="text"
									v-model="product"
									class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300"
								/>
							</div>

                            <check-product :name="product"/>
						</div>
					</div>
				</div>
			</div>

			<div class="pt-8">
				<div>
					<h3 class="text-lg leading-6 font-medium text-gray-900">
						Notification settings
					</h3>
					<p class="mt-1 text-sm text-gray-500">
						How would you like to be notified when the product is in
						stock?
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
						<div class="mt-1">
							<input
								id="email"
								type="email"
								v-model="email"
								class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
							/>
						</div>
					</div>

					<div class="sm:col-span-3">
						<label
							for="last_name"
							class="block text-sm font-medium text-gray-700"
						>
							Last name
						</label>
						<div class="mt-1">
							<input
								type="text"
								id="last_name"
								class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
							/>
						</div>
					</div>

					<div class="sm:col-span-3">
						<label
							for="country"
							class="block text-sm font-medium text-gray-700"
						>
							Country / Region
						</label>
						<div class="mt-1">
							<select
								id="country"
								class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
							>
								<option>United States</option>
								<option>Canada</option>
								<option>Mexico</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="pt-5">
			<div class="flex justify-end">
                <router-link
                    to="/"
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
</template>

<script>
import CheckProduct from '@/components/Stores/CheckProduct'
export default {
	data() {
		return {
			product: null,
			email: null,
		};
    },
    components: {
        CheckProduct
    },
	methods: {
		watch() {
			axios
				.post(`/api/watchers/watch/${this.$route.params.store}`, {
					product: this.product,
					email: this.email,
				})
				.then(({ data }) => {
                    if (data.success) {
                        
                    }
                });
		},
	},
};
</script>
