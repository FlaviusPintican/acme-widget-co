<?php

declare(strict_types=1);

namespace App\Tests\Unit\Delivery;

use App\Delivery\DeliveryCost;
use App\Delivery\DeliveryCostInterface;
use App\Enums\ProductEnumCode;
use App\Product;
use PHPUnit\Framework\TestCase;

class DeliveryCostTest extends TestCase
{
    private DeliveryCostInterface $deliveryCost;

    protected function setUp(): void
    {
        $this->deliveryCost = new DeliveryCost();
    }

    public function testUnder50(): void
    {
        $products = [
            new Product(ProductEnumCode::BLUE_WIDGET_CODE->getValue(), 'Blue Widget', 7.95),
        ];

        $this->assertSame(4.95, $this->deliveryCost->calculate($products, 4.95));
    }

    public function testUnder90(): void
    {
        $products = [
            new Product(ProductEnumCode::RED_WIDGET_CODE->getValue(), 'Red Widget', 32.95),
            new Product(ProductEnumCode::GREEN_WIDGET_CODE->getValue(), 'Green Widget', 24.95),
        ];

        $this->assertSame(2.95, $this->deliveryCost->calculate($products, 2.95));
    }

    public function testFreeOver90(): void
    {
        $products = [
            new Product(ProductEnumCode::RED_WIDGET_CODE->getValue(), 'Red Widget', 32.95),
            new Product(ProductEnumCode::RED_WIDGET_CODE->getValue(), 'Red Widget', 32.95),
            new Product(ProductEnumCode::GREEN_WIDGET_CODE->getValue(), 'Green Widget', 24.95),
        ];

        $this->assertSame(0.00, $this->deliveryCost->calculate($products, 0.00));
    }
}
