<?php

namespace App\Services\PricingRules;

use App\Services\Product;

readonly class BuyOneGetOneFreePricingRule implements PricingRule
{
    public function __construct(private Product $product) {}

    public function discount(array $products): int
    {
        $applicableSkus = array_filter($products, fn (Product $product) => $product->sku === $this->product->sku);
        $applicableSkusQuantity = count($applicableSkus);

        return $applicableSkusQuantity > 0 ? (int) floor($applicableSkusQuantity / 2) * $this->product->price : 0;
    }
}
