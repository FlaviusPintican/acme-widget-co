<?php

declare(strict_types=1);

namespace App\Offers;

use App\Product;

interface OfferInterface
{
    /**
     * @param Product[] $products
     * @return float
     */
    public function apply(array $products): float;
}
