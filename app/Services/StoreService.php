<?php

namespace App\Services;

use Exception;
use App\Models\Product;
use App\Stores\KomplettStore;
use App\Services\ScrapeService;
use App\Contracts\StoreServiceContract;
use App\Stores\NetOnNetStore;
use simplehtmldom_1_5\simple_html_dom_node;

class StoreService implements StoreServiceContract
{
    /** @var Product */
    private $product;

    /** @var mixed */
    public $store;

    /**
     * Create a new instance of service.
     *
     * @return void
     */
    public function __construct($store, Product $product = null)
    {
        $this->loadStore($store);
        $this->product = $product;
    }

    private function loadStore(string $store)
    {
        switch ($store) {
            case 'komplett':
                $this->store = new KomplettStore;
                break;

            case 'netonnet':
                $this->store = new NetOnNetStore;
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
        $product = $this->fetchProduct($this->product->product_name);
        if (!$product) {
            return;
        }

        $this->product->product_url = $product['details']['url'];
        $this->product->stock_status = $product['details']['stock'];
        $this->product->last_scan = now();

        $inStock = $this->store->productHasStock($product['node']);
        if ($inStock) {
            $this->product->notifyInStock();
            $this->product->found = 1;
        }

        $this->product->save();
    }

    /**
     * Updates the stock for the product
     *
     * @param simple_html_dom_node $stockNode 
     * @return void
     */
    public function setStockStatus(simple_html_dom_node $stockNode): void
    {
        if (!$this->product) {
            return;
        }

        $stock = $stockNode->getAttribute('title');

        $this->product->stock_status = $stock;
        $this->product->save();
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
