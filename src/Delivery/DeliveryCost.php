<?php

declare(strict_types=1);

namespace App\Delivery;

use App\Helpers\ProductHelper;

class DeliveryCost implements DeliveryCostInterface
{
    public const float DISCOUNT_ORDERS_UNDER_50_DOLLARS = 4.95;

    public const float DISCOUNT_ORDERS_OVER_50_AND_UNDER_90_DOLLARS = 2.95;

    public const float DISCOUNT_ORDERS_OVER_90_DOLLARS = 0;

    /**
     * {@inheritDoc}
     */
    public function calculate(array $products, float $discounts): float
    {
        $totalPrice = ProductHelper::getTotalPrice($products) - $discounts;

        if ($totalPrice >= 90) {
            return self::DISCOUNT_ORDERS_OVER_90_DOLLARS;
        }

        if ($totalPrice < 50) {
            return self::DISCOUNT_ORDERS_UNDER_50_DOLLARS;
        }

        return self::DISCOUNT_ORDERS_OVER_50_AND_UNDER_90_DOLLARS;
    }
}
