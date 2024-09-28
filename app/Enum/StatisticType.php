<?php

namespace App\Enum;

enum StatisticType: string
{
    case view = "view";
    case sale = "sale";
    case refund = "refund";
}
