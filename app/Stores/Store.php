<?php

namespace App\Stores;

use Illuminate\Support\Str;
use App\Contracts\StoreContract;
use simplehtmldom_1_5\simple_html_dom_node;

abstract class Store implements StoreContract
{
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getQueryPath(): string
    {
        return $this->queryPath;
    }

    public function getProductListClass(): string
    {
        return $this->productListClass;
    }

    public function getProductNameClass(): string
    {
        return $this->productNameClass;
    }

    public function getproductSubNameClass(): string
    {
        return $this->productSubNameClass;
    }

    public function getProductStockClass(): string
    {
        return $this->productStockClass;
    }

    public function getInStockText(): string
    {
        return $this->inStockText;
    }

    public function generateQuery(string $product): string
    {
        return $this->getBaseUrl() . $this->getQueryPath() . urlencode($product);
    }

    public function productHasStock(simple_html_dom_node $product): bool
    {
        return Str::startsWith(html_entity_decode($product->plaintext), $this->getInStockText());
    }
}
