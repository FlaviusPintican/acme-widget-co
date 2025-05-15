<?php

declare(strict_types=1);

namespace App\Basket;

use App\Catalogue;
use App\Delivery\DeliveryCostInterface;
use App\Helpers\ProductHelper;
use App\Offers\OfferInterface;
use App\Product;

class Basket implements BasketInterface
{
    /** @var Product[] $products */
    private array $products = [];

    /**
     * @param Catalogue $catalogue
     * @param DeliveryCostInterface $deliveryCost
     * @param OfferInterface[] $offers
     */
    public function __construct(
        private readonly Catalogue $catalogue,
        private readonly DeliveryCostInterface $deliveryCost,
        private readonly array $offers = []
    ) {

    }

    /**
     * {@inheritDoc}
     */
    public function add(string $productCode): void
    {
        $this->products[] = $this->catalogue->get($productCode);
    }

    /**
     * {@inheritDoc}
     */
    public function total(): float
    {
        $totalPrices = ProductHelper::getTotalPrice($this->products);
        $discounts = array_sum(
            array_map(fn (OfferInterface $offer) => $offer->apply($this->products), $this->offers)
        );

        $deliveryCost = $this->deliveryCost->calculate($this->products, $discounts);
        $totalPrices = $totalPrices - $discounts + $deliveryCost;

        return (float)bcdiv((string)$totalPrices, '1', 2);
    }
}
