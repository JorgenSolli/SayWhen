<?php

namespace App\Contracts;

use simplehtmldom_1_5\simple_html_dom_node;

interface StoreServiceContract
{
    /**
     * Fetches and updates the products stock status
     *
     * @return void 
     */
    public function updateProductStatus(): void;

    /**
     * Updates the stock for the product
     *
     * @param simple_html_dom_node $stockNode 
     * @return void
     */
    public function setStockStatus(simple_html_dom_node $stockNode): void;

    /**
     * Fetches a product from the store
     *
     * @param string $product 
     * @return mixed 
     */
    public function fetchProduct(string $product);
}
