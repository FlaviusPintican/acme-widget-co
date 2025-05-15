<?php

declare(strict_types=1);

namespace App\Basket;

interface BasketInterface
{
    /**
     * @param string $productCode
     * @return void
     */
    public function add(string $productCode): void;

    /**
     * @return float
     */
    public function total(): float;
}
