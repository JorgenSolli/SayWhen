<?php

namespace App\Stores;

use Illuminate\Support\Str;
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
    public $productListIdentifier = '.product-list-item';

    /** @var string */
    public $productNameIdentifier = '.text-content h2';

    /** @var string */
    public $productSubNameIdentifier = '.text-content p';

    /** @var string */
    public $productStockIdentifier = '.stockstatus-stock-details';

    /** @var string */
    public $productNumberIdentifier = '.product-data';

    /** @var string */
    public $inStockText = 'på lager';

    /** @var string */
    public $notInStockText = 'ikke';

    /** @var string */
    public $logo = 'https://www.komplett.no/logo/310/logo_b2c.svg';

    public function parseProduct(simple_html_dom_node $productNode): array
    {
        $title = $productNode->find($this->getProductNameIdentifier())[0]->text();
        $subTitle = $productNode->find($this->getproductSubNameIdentifier())[0]->text();
        $url = $this->getBaseUrl() . $productNode->firstChild('a')->getAttribute('href');
        $stockNode = $productNode->find($this->getproductStockIdentifier())[0] ?? null;
        $stock = $stockNode ? html_entity_decode($stockNode->text()) : null;
        $hasStock = $stockNode ? $this->productHasStock($stockNode) : null;
        $productNumber = $productNode->find($this->productNumberIdentifier)[0]->firstChild()->text() ?? null;

        $product = [
            'title' => html_entity_decode($title),
            'sub_title' => html_entity_decode($subTitle),
            'product_number' => trim(html_entity_decode($productNumber)),
            'stock' => $stock,
            'has_stock' => $hasStock,
            'url' => html_entity_decode($url),
        ];

        return $product;
    }

    public function matchesProductNumber(simple_html_dom_node $productNrNode, $productNumner): bool
    {
        return Str::contains(strtolower($productNrNode->text()), strtolower($productNumner));
    }
}
