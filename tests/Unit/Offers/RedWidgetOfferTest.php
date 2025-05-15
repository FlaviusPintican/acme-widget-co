<?php

declare(strict_types=1);

namespace App\Tests\Unit\Offers;

use App\Offers\OfferInterface;
use App\Offers\RedWidgetOffer;
use App\Product;
use PHPUnit\Framework\TestCase;

class RedWidgetOfferTest extends TestCase
{
    private OfferInterface $offer;

    public function setUp(): void
    {
        $this->offer = new RedWidgetOffer();
    }

    public function testDiscountAppliedCorrectly(): void
    {
        $products = [
            new Product('R01', 'Red Widget', 32.95),
            new Product('R01', 'Red Widget', 32.95),
            new Product('R01', 'Red Widget', 32.95),
        ];

        $this->assertSame(16.475, $this->offer->apply($products));
    }

    public function testNoDiscountOnNonRedWidgets(): void
    {
        $products = [
            new Product('B01', 'Blue Widget', 7.95),
        ];

        $this->assertSame(0.0, $this->offer->apply($products));
    }
}
