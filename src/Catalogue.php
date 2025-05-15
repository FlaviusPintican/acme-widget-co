<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

class Catalogue
{
    /**
     * @var Product[] $products
     */
    private array $products = [];

    /**
     * @param Product[] $products
     */
    public function __construct(array $products)
    {
        foreach ($products as $product) {
            $this->products[$product->code] = $product;
        }
    }

    /**
     * @param string $code
     * @return Product
     */
    public function get(string $code): Product
    {
        if (!isset($this->products[$code])) {
            throw new InvalidArgumentException("Invalid product code: $code");
        }

        return $this->products[$code];
    }
}
