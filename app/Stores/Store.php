<?php

namespace App\Stores;

use Illuminate\Support\Str;
use App\Contracts\StoreContract;
use simplehtmldom_1_5\simple_html_dom_node;

abstract class Store implements StoreContract
{
    public function getIdentifier(): string
    {
        return Str::slug($this->name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getQueryPath(): string
    {
        return $this->queryPath;
    }

    public function getProductListIdentifier(): string
    {
        return $this->productListIdentifier;
    }

    public function getProductNameIdentifier(): string
    {
        return $this->productNameIdentifier;
    }

    public function getproductSubNameIdentifier(): string
    {
        return $this->productSubNameIdentifier;
    }

    public function getProductStockIdentifier(): string
    {
        return $this->productStockIdentifier;
    }

    public function getProductNumberIdentifier(): string
    {
        return $this->productNumberIdentifier;
    }

    public function getInStockText(): string
    {
        return $this->inStockText;
    }

    public function getNotInStockText(): string
    {
        return $this->notInStockText;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function generateQuery(string $product): string
    {
        return $this->getBaseUrl() . $this->getQueryPath() . urlencode($product);
    }

    public function productHasStock(simple_html_dom_node $product): bool
    {
        $stockText = html_entity_decode($product->plaintext);

        return Str::contains($stockText, $this->getInStockText()) && !Str::contains($stockText, $this->getNotInStockText());
    }
}
