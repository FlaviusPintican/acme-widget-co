<?php

declare(strict_types=1);

namespace App;

readonly class Product
{
    /**
     * @param string $code
     * @param string $name
     * @param float $price
     */
    public function __construct(
        public string $code,
        public string $name,
        public float $price
    ) {

    }
}
