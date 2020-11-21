<?php

namespace App\Http\Controllers\API;

use App\Stores\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = config('stores.list')->map(function($s) {
            /** @var Store */
            $store = $s;

            return [
                'id' => $store->getIdentifier(),
                'name' => $store->getName(),
                'url' => $store->getBaseUrl(),
                'logo' => $store->getLogo(),
            ];
        });

        return [
            'stores' => $stores,
        ];
    }

    /**
     * Looks up a product on the store.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lookup(string $store, Request $request)
    {
        $product = $request->get('product');
        $productNr = $request->get('product_nr');

        $storeService = new StoreService($store);
        $product = $storeService->fetchProduct($product, $productNr);

        return [
            'success' => (bool) $product,
            'product' => $product['details'] ?? null,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
