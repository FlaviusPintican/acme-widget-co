<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductEnumCode: string
{
    case RED_WIDGET_CODE = 'R01';
    case GREEN_WIDGET_CODE = 'G01';
    case BLUE_WIDGET_CODE = 'B01';

    public function getValue(): string
    {
        return $this->value;
    }
}
