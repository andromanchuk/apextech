<?php

namespace App\Services;

readonly class Product
{
    public function __construct(
        public string $sku,
        public string $name,
        public int $price,
    ) {}
}
