<?php

namespace App\Stores;

use simplehtmldom_1_5\simple_html_dom_node;

class KomplettStore extends Store
{
    /** @var string */
    public $baseUrl = 'https://komplett.no';

    /** @var string */
    public $queryPath = '/search?q=';

    /** @var string */
    public $productListClass = '.product-list-item';

    /** @var string */
    public $productNameClass = '.text-content h2';

    /** @var string */
    public $productSubNameClass = '.text-content p';

    /** @var string */
    public $productStockClass = '.stockstatus-stock-details';

    /** @var string */
    public $inStockText = 'på lager';

    public function parseProduct(simple_html_dom_node $productNode): array
    {
        $title = $productNode->find($this->getProductNameClass())[0]->text();
        $subTitle = $productNode->find($this->getproductSubNameClass())[0]->text();
        $url = $this->getBaseUrl() . $productNode->firstChild('a')->getAttribute('href');
        $stockNode = $productNode->find($this->getproductStockClass())[0];
        $stock = $stockNode->text();
        $hasStock = $this->productHasStock($stockNode);

        $product = [
            'title' => html_entity_decode($title),
            'sub_title' => html_entity_decode($subTitle),
            'stock' => html_entity_decode($stock),
            'has_stock' => $hasStock,
            'url' => html_entity_decode($url),
        ];

        return $product;
    }
}