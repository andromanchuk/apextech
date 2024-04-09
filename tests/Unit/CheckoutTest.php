<?php

namespace Tests\Unit;

use App\Services\Checkout;
use App\Services\PricingRules\BulkPurchaseDiscountPriceRule;
use App\Services\PricingRules\BuyOneGetOneFreePricingRule;
use App\Services\Product;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    public function test_total_price_is_discounted_correctly(): void
    {
        $fr1 = new Product('FR1', 'Fruit tea', 311);
        $sr1 = new Product('SR1 ', 'Strawberries', 500);
        $cf1 = new Product('CF1', 'Coffee', 1123);

        $pricingRules = [
            new BuyOneGetOneFreePricingRule($fr1),
            new BulkPurchaseDiscountPriceRule($sr1, 50),
        ];

        $checkout = new Checkout($pricingRules);
        $checkout->scan($fr1);
        $checkout->scan($sr1);
        $checkout->scan($fr1);
        $checkout->scan($fr1);
        $checkout->scan($cf1);
        $this->assertEquals('22.45', $checkout->total());

        $checkout = new Checkout($pricingRules);
        $checkout->scan($fr1);
        $checkout->scan($fr1);
        $this->assertEquals('3.11', $checkout->total());

        $checkout = new Checkout($pricingRules);
        $checkout->scan($sr1);
        $checkout->scan($sr1);
        $checkout->scan($fr1);
        $checkout->scan($sr1);
        $this->assertEquals('16.61', $checkout->total());
    }
}
