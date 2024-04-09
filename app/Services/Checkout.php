<?php

namespace App\Services;

use App\Services\PricingRules\PricingRule;

class Checkout
{
    /**
     * @var array<Product>
     */
    private array $products = [];

    /**
     * @param array<PricingRule> $pricingRules
     */
    public function __construct(private readonly array $pricingRules) {}

    public function scan(Product $product): void
    {
        $this->products[] = $product;
    }

    public function total(): string
    {
        $totalPrice = 0;

        foreach ($this->products as $product) {
            $totalPrice += $product->price;
        }

        foreach ($this->pricingRules as $pricingRule) {
            $totalPrice -= $pricingRule->discount($this->products);
        }

        return number_format($totalPrice / 100, 2);
    }
}
