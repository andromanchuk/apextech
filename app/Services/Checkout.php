<?php

namespace App\Checkout;

class Checkout
{
    private array $items = [];

    public function __construct(private array $pricingRules) {}

    public function scan($item): void
    {
        $this->items[] = $item;
    }

    public function total(): string
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {

        }

        return number_format($totalPrice, 2);
    }
}
