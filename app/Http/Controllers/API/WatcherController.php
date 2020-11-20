<?php

namespace App\Http\Controllers\API;

use App\Models\Watcher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WatcherResource;
use App\Services\StoreService;

class WatcherController extends Controller
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

        $products = Watcher::where('email', $request->get('email'))->get();

        return [
            'success' => true,
            'watchers' => WatcherResource::collection($products),
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
        $email = $request->get('email');
        $product = $request->get('product');
        $productNr = $request->get('product_nr');

        $storeService = new StoreService($store);
        $productData = $storeService->fetchProduct($product, $productNr);

        Watcher::create([
            'email' => $email,
            'product_name' => $product,
            'product_url' => $productData['details']['url'],
            'product_nr' => $productNr,
            'stock_status' => $productData['details']['stock'],
            'found' => (int) $productData['details']['has_stock'],
            'last_scan' => now(),
            'store' => $store,
        ]);

        if ($productData['details']['has_stock']) {
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
}
