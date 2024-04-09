<?php

namespace App\Services\PricingRules;

use App\Services\Product;

readonly class BulkPurchaseDiscountPriceRule implements PricingRule
{
    public function __construct(
        private Product $product,
        private int $productDiscount
    ) {}

    public function discount(array $products): int
    {
        $applicableSkus = array_filter($products, fn (Product $product) => $product->sku === $this->product->sku);
        $applicableSkusQuantity = count($applicableSkus);

        return $applicableSkusQuantity >= 3 ? $applicableSkusQuantity * $this->productDiscount : 0;
    }
}
