<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\StoreService;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\VerifiedEmail;

class ProductController extends Controller
{
    /**
     * @todo add store middleware to 404 if store doesnt exist
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->has('email')) {
            return [
                'success' => false,
                'message' => 'Missing email',
            ];
        }

        $products = Product::where('email', $request->get('email'))->get();
        $emailVerified = VerifiedEmail::where([
            'email' =>  $request->get('email'),
            'verified' => 1,
        ])->first();

        return [
            'success' => true,
            'products' => ProductResource::collection($products),
            'email_verified' => (bool) $emailVerified,
        ];
    }

    /**
     * Reads the specific Product
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function read(Product $product)
    {
        (new StoreService($product->store, $product))->updateProduct();

        return [
            'success' => true,
            'product' => new ProductResource($product),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(string $store, Request $request)
    {
        $request->validate([
            'product' => 'required',
            'email' => 'required|email',
        ]);

        $email = $request->get('email');
        $product = $request->get('product');
        $productNr = $request->get('product_nr');

        $storeService = new StoreService($store);

        $hasProduct = $storeService->isAlreadyWatching($email, $product, $productNr);

        if ($hasProduct) {
            return [
                'success' => false,
                'message'=> "You are already watching a product with this name",
            ];
        }

        $productData = $storeService->fetchProduct($product, $productNr);
        $hasStock = isset($productData['details']['has_stock']) ? 1 : 0;

        Product::create([
            'email' => $email,
            'product_name' => strip_tags($product),
            'product_url' => $productData['details']['url'] ?? null,
            'product_nr' => $productNr,
            'stock_status' => $productData['details']['stock'] ?? null,
            'found' => $hasStock,
            'last_scan' => now(),
            'store' => $store,
        ]);

        if ($hasStock) {
            return [
                'success' => true,
                'message'=> "The product was added to the list, but it seems like it's already in stock.",
            ];
        }

        return [
            'success' => true,
            'message'=> 'The product is now being watched',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return [
            'success' => true,
            'message'=> 'The product has been deleted',
        ];        
    }
}
