<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Product;

class ProductHelper
{
    /**
     * @param Product[] $products
     * @return float
     */
    public static function getTotalPrice(array $products): float
    {
        return array_sum(
            array_map(fn (Product $product) => $product->price, $products)
        );
    }
}
