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

    /**
     * Loads the store service
     * 
     * @param string $store
     */
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
        $product = $this->fetchProduct($this->product->product_name, $this->product->product_nr);
        if (!$product) {
            $this->product->last_scan = now();
            $this->product->save();

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
     * Queries the store and returns the products
     *
     * @param string $product
     * @param string|int|null $productNr
     * @return bool|array
     */
    public function fetchProducts(string $product, $productNr = null)
    {
        $endpoint = $this->store->generateQuery($product);
        $scrapeService = new ScrapeService($endpoint, $this);
        $productNodes = $scrapeService->fetchProducts($product, $productNr);

        if (!count($productNodes)) {
            return false;
        }

        $products = [];
        foreach ($productNodes as $productNode) {
            $products[] = $this->store->parseProduct($productNode);
        }

        return $products;
    }

    /**
     * Prases the product
     *
     * @param string $product
     * @param string|int|null $productNr
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

    /**
     * Checks if the entry already exists
     *
     * @param string $email
     * @param string $product
     * @param string $productNr = null
     * @return bool
     */
    public function isAlreadyWatching(string $email, string $product, string $productNr = null): bool
    {
        return Product::where('store', $this->store->getIdentifier())->where(function($query) use ($email, $product, $productNr) {
            $query->where('email', $email);
            $query->where('product_name', $product);

            if ($productNr) {
                $query->where('product_nr', $productNr);
            }
        })->count();
    }

    /**
     * Gets the details for the store
     * 
     * @return array
     */
    public function getStoreData(): array
    {
        return [
            'name' => $this->store->getName(),
            'url' => $this->store->getBaseUrl(),
            'logo' => $this->store->getLogo(),
        ];
    }
}
