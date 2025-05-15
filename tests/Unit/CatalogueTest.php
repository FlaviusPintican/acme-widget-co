<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Catalogue;
use App\Enums\ProductEnumCode;
use App\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CatalogueTest extends TestCase
{
    public function testGetProductByCode(): void
    {
        $products = [
            new Product(
                ProductEnumCode::RED_WIDGET_CODE->getValue(),
                'Red Widget',
                32.95
            ),
        ];

        $catalogue = new Catalogue($products);
        $product = $catalogue->get(ProductEnumCode::RED_WIDGET_CODE->getValue());

        $this->assertInstanceOf(Product::class, $product);
    }

    public function testNoProductFoundByCode(): void
    {
        $products = [
            new Product(
                ProductEnumCode::BLUE_WIDGET_CODE->getValue(),
                'Blue Widget',
                7.95
            ),
        ];

        $catalogue = new Catalogue($products);
        $this->expectException(InvalidArgumentException::class);
        $catalogue->get(ProductEnumCode::RED_WIDGET_CODE->getValue());
    }
}
