<?php

declare(strict_types=1);

namespace App\Delivery;

use App\Product;

interface DeliveryCostInterface
{
    /**
     * @param Product[] $products
     * @param float $discounts
     * @return float
     */
    public function calculate(array $products, float $discounts): float;
}
