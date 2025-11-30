<?php

namespace App\Http\Enums;

use App\Traits\CollectedEnum;

enum TransactionTypeEnum: string
{
    use CollectedEnum;

    case PURCHASE = 'purchase';

    case REFUND = 'refund';
}
