<?php

namespace App\Services\PricingRules;

use App\Services\Product;

interface PricingRule
{
    /**
     * @param array<Product> $products
     * @return int
     */
    public function discount(array $products): int;
}
