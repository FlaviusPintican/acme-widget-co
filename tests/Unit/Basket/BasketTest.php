<?php

declare(strict_types=1);

namespace App\Tests\Unit\Basket;

use App\Basket\Basket;
use App\Catalogue;
use App\Delivery\DeliveryCost;
use App\Delivery\DeliveryCostInterface;
use App\Enums\ProductEnumCode;
use App\Offers\OfferInterface;
use App\Product;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAddProduct(): void
    {
        $catalogue = $this->createMock(Catalogue::class);
        $product = new Product(ProductEnumCode::GREEN_WIDGET_CODE->getValue(), 'Green Widget', 24.95);

        $catalogue->expects($this->once())->method('get')->willReturn($product);
        $deliveryCost = $this->createMock(DeliveryCost::class);

        $basket = new Basket($catalogue, $deliveryCost);

        $basket->add(ProductEnumCode::GREEN_WIDGET_CODE->getValue());
    }

    /**
     * @throws Exception
     */
    public function testTotalPrice(): void
    {
        $product = new Product(ProductEnumCode::GREEN_WIDGET_CODE->getValue(), 'Green Widget', 24.95);

        $catalogue = $this->createMock(Catalogue::class);
        $catalogue->expects($this->once())
            ->method('get')
            ->with(ProductEnumCode::GREEN_WIDGET_CODE->getValue())
            ->willReturn($product);

        $deliveryCost = $this->createMock(DeliveryCostInterface::class);
        $deliveryCost->expects($this->once())
            ->method('calculate')
            ->with([$product], 0.00)
            ->willReturn(DeliveryCost::DISCOUNT_ORDERS_UNDER_50_DOLLARS);

        $offer = $this->createMock(OfferInterface::class);
        $offer->expects($this->once())
            ->method('apply')
            ->with([$product])
            ->willReturn(0.00);

        $basket = new Basket($catalogue, $deliveryCost, [$offer]);
        $basket->add(ProductEnumCode::GREEN_WIDGET_CODE->getValue());

        $this->assertEquals(29.9, $basket->total());
    }
}
