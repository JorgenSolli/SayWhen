<?php

namespace App\Stores;

use simplehtmldom_1_5\simple_html_dom_node;

class NetOnNetStore extends Store
{
    /** @var string */
    public $name = 'NetOnNet';

    /** @var string */
    public $baseUrl = 'https://netonnet.no';

    /** @var string */
    public $queryPath = '/Search?query=';

    /** @var string */
    public $productListIdentifier = '.cProductItem';

    /** @var string */
    public $productNameIdentifier = '.panel-body .shortText a';

    /** @var string */
    public $productSubNameIdentifier = '.panel-body .subTitle';

    /** @var string */
    public $productStockIdentifier = '.warehouseStockStatusContainer';

    /** @var string */
    public $productNumberIdentifier = 'input[name="ProductId"]';

    /** @var string */
    public $inStockText = '.stockStatusInStock';

    /** @var string */
    public $notInStockText = '.stockStatusOutOfStock';

    /** @var string */
    public $logo = 'https://www.netonnet.no/Assets/Images/netonnet-logo-highres.png';

    /**
     * Parses the needed product details
     * 
     * @param simple_html_dom_node $productNode
     * @return array
     */
    public function parseProduct(simple_html_dom_node $productNode): array
    {
        $title = $productNode->find($this->getProductNameIdentifier())[0]->text();
        $subTitle = $productNode->find($this->getproductSubNameIdentifier())[0]->text();
        $url = $this->getBaseUrl() . $productNode->firstChild('a')->getAttribute('href');
        $stockNode = $productNode->find($this->getproductStockIdentifier())[0] ?? null;
        $stock = $stockNode ? $this->getStockText($stockNode) : null;
        $hasStock = $stockNode ? $this->productHasStock($stockNode) : null;

        $product = [
            'title' => html_entity_decode($title),
            'sub_title' => html_entity_decode($subTitle),
            'stock' => $stock,
            'has_stock' => $hasStock,
            'url' => html_entity_decode($url),
        ];

        return $product;
    }

    /**
     * Checks if product is in stock
     * 
     * @param simple_html_dom_node $productNode
     * @return bool
     */
    public function productHasStock(simple_html_dom_node $productNode): bool
    {
        $inStock = $productNode->find($this->getInStockText())[0] ?? false;

        return (bool) $inStock;
    }

    /**
     * NetOnNet does not show specific stock numbers
     * 
     * @param simple_html_dom_node $productNode
     * @return string
     */
    public function getStockText(simple_html_dom_node $productNode): string
    {
        $inStock = $productNode->find($this->getInStockText())[0] ?? false;

        return $inStock ? 'In stock' : 'Not in stock';
    }
}
