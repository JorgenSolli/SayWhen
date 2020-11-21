<?php

namespace App\Contracts;

interface StoreContract
{
    public function getBaseUrl(): string;
    public function getQueryPath(): string;
    public function getProductListIdentifier(): string;
    public function getProductNameIdentifier(): string;
    public function getProductStockIdentifier(): string;
    public function getInStockText(): string;
    public function generateQuery(string $product): string;
}