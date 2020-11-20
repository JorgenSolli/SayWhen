<?php

namespace App\Services;

use Exception;
use App\Models\Watcher;
use Illuminate\Support\Str;
use App\Stores\KomplettStore;
use App\Services\ScrapeService;
use App\Contracts\StoreServiceContract;
use simplehtmldom_1_5\simple_html_dom_node;

class StoreService implements StoreServiceContract
{
    /** @var Watcher */
    private $watcher;

    /** @var mixed */
    public $store;

    /**
     * Create a new instance of service.
     *
     * @return void
     */
    public function __construct($store, Watcher $watcher = null)
    {
        $this->loadStore($store);
        $this->watcher = $watcher;
    }

    private function loadStore(string $store)
    {
        switch ($store) {
            case 'komplett':
                $this->store = new KomplettStore;
                break;

            default:
                throw new Exception($store . ' is not a valid store');
                break;
        }
    }

    /**
     * Fetches and updates the products stock status
     *
     * @return void 
     */
    public function updateProductStatus(): void
    {
        $inStock = $this->productHasStock($this->watcher->product_name);

        if ($inStock) {
            $this->watcher->found = 1;
            $this->watcher->save();
        }
    }

    /**
     * Updates the stock for the product
     *
     * @param simple_html_dom_node $stockNode 
     * @return void
     */
    public function setStockStatus(simple_html_dom_node $stockNode): void
    {
        if (!$this->watcher) {
            return;
        }

        $stock = $stockNode->getAttribute('title');

        $this->watcher->stock_status = $stock;
        $this->watcher->save();
    }

    /**
     * Prases the product
     *
     * @param string $product 
     * @return bool|array
     */
    public function fetchProduct(string $product)
    {
        $endpoint = $this->store->generateQuery($product);
        $scrapeService = new ScrapeService($endpoint, $this);
        $productNode = $scrapeService->fetchProduct($product, $this->store);

        if (!$productNode) {
            return false;
        }

        $parsedProduct = $this->store->parseProduct($productNode);

        return $parsedProduct;
    }
}
