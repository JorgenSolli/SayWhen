<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WatcherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'store' => $this->getStore(),
            'email' => $this->email,
            'product_name' => $this->product_name,
            'product_url' => $this->product_url,
            'found' => $this->found,
            'stock_status' => $this->stock_status ?? 'Could not get stock data',
            'last_scan' => $this->last_scan->format('d M Y H:i'),
            'created_at' => $this->created_at->format('d M Y H:i'),
        ];
    }
}
