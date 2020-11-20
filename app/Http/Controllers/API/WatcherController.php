<?php

namespace App\Http\Controllers\API;

use App\Models\Watcher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WatcherController extends Controller
{
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

        $lists = Watcher::where('email', $request->get('emil'))->get();
dd($lists);
        return [

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
        $stores = config('stores.list');
        $store = $stores[$store] ?? false;

        if (!$store) {
            return [
                'success' => false,
                'message'=> $store . ' is not a valid store',
            ];
        }

        $email = $request->get('email');
        $product = $request->get('product');

        Watcher::create([
            'email' => $email,
            'product_name' => $product,
        ]);

        return [
            'success' => true,
            'message'=> 'The product is now being watched',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Watcher  $watcher
     * @return \Illuminate\Http\Response
     */
    public function show(Watcher $watcher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Watcher  $watcher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watcher $watcher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Watcher  $watcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watcher $watcher)
    {
        //
    }
}
