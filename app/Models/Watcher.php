<?php

namespace App\Models;

use App\Services\StoreService;
use App\Notifications\ProductInStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Watcher extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store',
        'email',
        'product_name',
        'product_url',
        'product_nr',
        'found',
        'last_scan',
        'stock_status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_scan',
    ];

    public function getStore(): array
    {
        $store = new StoreService($this->store);
        return $store->getStoreData();
    }

    public function notifyInStock(): void
    {
        $this->notify(new ProductInStock($this));
    }
}
