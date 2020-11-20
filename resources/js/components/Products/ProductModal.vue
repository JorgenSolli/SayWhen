<template>
	<transition
		enter-active-class="ease-out duration-300"
		leave-active-class="ease-in duration-200"
		enter-class="opacity-0"
		enter-to-class="opacity-100"
		leave-class="opacity-100"
		leave-to-class="opacity-0"
	>
		<div v-if="open" class="fixed z-10 inset-0 overflow-y-auto">
			<div
				class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
			>
				<div
					v-if="open"
					class="fixed inset-0 transition-opacity"
					aria-hidden="true"
				>
					<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
				</div>

				<!-- This element is to trick the browser into centering the modal contents. -->
				<span
					class="hidden sm:inline-block sm:align-middle sm:h-screen"
					aria-hidden="true"
					>&#8203;</span
				>

				<div
					v-if="open"
					class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
					role="dialog"
					aria-modal="true"
					aria-labelledby="modal-headline"
				>
					<div v-if="product">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            We found the following product
                        </h3>
                        <div class="mt-2">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-sm font-medium truncate" v-text="product.title"/>
                            </div>
                            <p class="mt-1 text-gray-500 text-sm truncate" v-text="product.sub_title"/>
                            <p
								v-if="product.stock"
                                :class="product.has_stock ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                class="flex-shrink-0 inline-block px-2 py-0.5 text-xs font-medium rounded-full"
                                v-text="product.stock"
                            />
							<p
								v-else
                                class="bg-red-100 text-red-800 flex-shrink-0 inline-block px-2 py-0.5 text-xs font-medium rounded-full"
                            >
								Looks like it's out of stock
							</p>
                        </div>
					</div>
                    <div v-else>
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
							<svg
								class="h-6 w-6 text-red-600"
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 20 20"
								fill="currentColor"
							>
								<path
									fill-rule="evenodd"
									d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
									clip-rule="evenodd"
								/>
							</svg>
						</div>

						<div class="mt-3 text-center sm:mt-5">
							<h3 class="text-lg leading-6 font-medium text-gray-900">
								No products found
							</h3>
							<div class="mt-2">
								<p class="text-sm text-gray-500">
									Maybe the product hasn't released yet? In that case, you can still add the product to 
                                    your watch list.
								</p>
							</div>
						</div>
					</div>

                    <div :class="{'sm:grid-cols-2': product}" class="mt-5 sm:mt-6 sm:grid sm:gap-3 sm:grid-flow-row-dense">
                        <button
                            @click="close"
                            type="button"
                            :class="{'w-6/12': product}"
							class="w-full inline-flex justify-center rounded-md border shadow-sm px-4 py-2 text-base font-medium text-white focus:ring-2 focus:ring-offset-2 sm:text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Close
                        </button>

                        <a
                            v-if="product"
                            :href="product.url"
                            target="_blank"
							border-gray-300
							bg-white
							class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                        >
                            View Product
                        </a>
                    </div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
export default {
	data() {
		return {
			open: false,
		};
	},
	props: {
		product: {
			required: true,
		},
		isOpen: Boolean,
	},
	watch: {
		isOpen() {
			this.open = this.isOpen;
		},
	},
	methods: {
		close() {
			this.$emit("closed");
		},
	},
};
</script>
