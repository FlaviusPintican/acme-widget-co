<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Basket\Basket;
use App\Catalogue;
use App\Delivery\DeliveryCost;
use App\Enums\ProductEnumCode;
use App\Offers\RedWidgetOffer;
use App\Product;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private Catalogue $catalogue;

    protected function setUp(): void
    {
        $this->catalogue = new Catalogue(
            [
                new Product(ProductEnumCode::RED_WIDGET_CODE->getValue(), 'Red Widget', 32.95),
                new Product(ProductEnumCode::GREEN_WIDGET_CODE->getValue(), 'Green Widget', 24.95),
                new Product(ProductEnumCode::BLUE_WIDGET_CODE->getValue(), 'Blue Widget', 7.95),
            ]
        );
    }

    public function testBasketCase1(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCost(),
            [
                new RedWidgetOffer()
            ],
        );

        $basket->add(ProductEnumCode::BLUE_WIDGET_CODE->getValue());
        $basket->add(ProductEnumCode::GREEN_WIDGET_CODE->getValue());

        $this->assertSame(37.85, $basket->total());
    }

    public function testBasketCase2(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCost(),
            [
                new RedWidgetOffer()
            ],
        );

        $basket->add(ProductEnumCode::RED_WIDGET_CODE->getValue());
        $basket->add(ProductEnumCode::RED_WIDGET_CODE->getValue());

        $this->assertSame(54.37, $basket->total());
    }

    public function testBasketCase3(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCost(),
            [
                new RedWidgetOffer()
            ],
        );

        $basket->add(ProductEnumCode::RED_WIDGET_CODE->getValue());
        $basket->add(ProductEnumCode::GREEN_WIDGET_CODE->getValue());

        $this->assertSame(60.85, $basket->total());
    }

    public function testBasketCase4(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryCost(),
            [
                new RedWidgetOffer()
            ],
        );

        $basket->add(ProductEnumCode::BLUE_WIDGET_CODE->getValue());
        $basket->add(ProductEnumCode::BLUE_WIDGET_CODE->getValue());

        $basket->add(ProductEnumCode::RED_WIDGET_CODE->getValue());
        $basket->add(ProductEnumCode::RED_WIDGET_CODE->getValue());
        $basket->add(ProductEnumCode::RED_WIDGET_CODE->getValue());

        $this->assertSame(98.27, $basket->total());
    }
}
