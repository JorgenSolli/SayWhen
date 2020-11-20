<?php

namespace App\Services;

use Illuminate\Support\Str;
use Eddieace\PhpSimple\HtmlDomParser;
use simplehtmldom_1_5\simple_html_dom;

class ScrapeService
{
    /** @var string */
    protected $endpoint;

    /** @var KomplettService */
    protected $storeService;

    /**
     * Create a new instance of service.
     *
     * @return void
     */
    public function __construct(string $endpoint, $storeService)
    {
        $this->endpoint = $endpoint;
        $this->storeService = $storeService;
    }

    public function getContents(): simple_html_dom
    {
        return HtmlDomParser::file_get_html($this->endpoint);
    }

    public function fetchProduct(string $product)
    {
        $html = $this->getContents();
        if (!Str::contains($html->plaintext, $product)) {
            return;
        }

        $listClass = $this->storeService->store->getProductListClass();
        $nameClass = $this->storeService->store->getProductNameClass();
        $stockClass = $this->storeService->store->getProductStockClass();

        $products = $html->find($listClass);
        foreach ($products as $productNode) {
            $productNameNode = $productNode->find($nameClass)[0] ?? null;
            if (!$productNameNode) {
                continue;
            }
            
            if (!Str::contains(strtolower($productNameNode->plaintext), strtolower($product))) {
                continue;
            }
            
            $stockStatus = $productNode->find($stockClass)[0] ?? null;
            if (!$stockStatus) {
                continue;
            }

            $this->storeService->setStockStatus($stockStatus);

            return $productNode;
        }

        return false;
    }
}