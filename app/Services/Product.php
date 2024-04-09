<?php

namespace App\Services;

readonly class Item
{
    public function __construct(
        public string $sku,
        public string $name,
        public int $price,
    ) {}
}
