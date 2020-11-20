<?php

namespace App\Services;

use Exception;
use App\Models\Watcher;
use App\Stores\KomplettStore;
use App\Services\ScrapeService;
use App\Contracts\StoreServiceContract;
use App\Mail\ProductInStock;
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
    public function updateProduct(): void
    {
        $product = $this->fetchProduct($this->watcher->product_name);
        if (!$product) {
            return;
        }

        $this->watcher->product_url = $product['details']['url'];
        $this->watcher->stock_status = $product['details']['stock'];
        $this->watcher->last_scan = now();

        $inStock = $this->store->productHasStock($product['node']);
        if ($inStock) {
            $this->watcher->notifyInStock();
            $this->watcher->found = 1;
        }

        $this->watcher->save();
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
     * @param string|int $productNr
     * @return bool|array
     */
    public function fetchProduct(string $product, $productNr = null)
    {
        $endpoint = $this->store->generateQuery($product);
        $scrapeService = new ScrapeService($endpoint, $this);
        $productNode = $scrapeService->fetchProduct($product, $productNr);

        if (!$productNode) {
            return false;
        }

        $parsedProduct = $this->store->parseProduct($productNode);

        return [
            'node' => $productNode,
            'details' => $parsedProduct,
        ];
    }

    public function getStoreData(): array
    {
        return [
            'name' => $this->store->getName(),
            'url' => $this->store->getBaseUrl(),
            'logo' => $this->store->getLogo(),
        ];
    }
}
