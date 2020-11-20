<?php

namespace App\Stores;

use simplehtmldom_1_5\simple_html_dom_node;

class KomplettStore extends Store
{
    /** @var string */
    public $name = 'Komplett';

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
    public $productNumberClass = '.product-data';

    /** @var string */
    public $inStockText = 'på lager';

    /** @var string */
    public $notInStockText = 'ikke';

    /** @var string */
    public $logo = 'https://www.komplett.no/logo/310/logo_b2c.svg';

    public function parseProduct(simple_html_dom_node $productNode): array
    {
        $title = $productNode->find($this->getProductNameClass())[0]->text();
        $subTitle = $productNode->find($this->getproductSubNameClass())[0]->text();
        $url = $this->getBaseUrl() . $productNode->firstChild('a')->getAttribute('href');
        $stockNode = $productNode->find($this->getproductStockClass())[0] ?? null;
        $stock = $stockNode ? html_entity_decode($stockNode->text()) : null;
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
}
