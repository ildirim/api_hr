<?php

namespace App\Http\Enums;

use App\Traits\CollectedEnum;

enum TransactionStatusEnum: string
{
    use CollectedEnum;

    case PENDING = 'pending';

    case COMPLETED = 'completed';

    case REJECTED = 'rejected';

    case FAILED = 'failed';

    case REFUNDED = 'refunded';
}
