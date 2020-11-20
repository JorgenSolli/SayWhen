<?php

namespace App\Contracts;

interface StoreContract
{
    public function getBaseUrl(): string;
    public function getQueryPath(): string;
    public function getProductListClass(): string;
    public function getProductNameClass(): string;
    public function getProductStockClass(): string;
    public function getInStockText(): string;
    public function generateQuery(string $product): string;
}