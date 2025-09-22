<?php

namespace App\Http\Enums;

enum SubscriptionPlanEnum: int
{
    case BASIC = 4001;
    case STANDARD = 4002;
    case PREMIUM = 4003;
}
