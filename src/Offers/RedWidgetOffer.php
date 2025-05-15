<?php

declare(strict_types=1);

namespace App\Offers;

use App\Enums\ProductEnumCode;
use App\Product;

class RedWidgetOffer implements OfferInterface
{
    private const float RED_WIDGET_PRICE = 32.95;

    /**
     * {@inheritDoc}
     */
    public function apply(array $products): float
    {
        $redWidgets = array_filter(
            $products,
            fn (Product $product) => $product->code === ProductEnumCode::RED_WIDGET_CODE->getValue()
        );

        // the second product gets a 50 % discount
        $discounts = intdiv(count($redWidgets), 2);

        return $discounts * (self::RED_WIDGET_PRICE / 2);
    }
}
