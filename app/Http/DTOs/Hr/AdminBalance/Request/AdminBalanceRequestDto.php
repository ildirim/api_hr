<?php

namespace App\Http\DTOs\Hr\AdminBalance\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Optional;

class AdminBalanceRequestDto extends CoreData
{
    public function __construct(
        #[Required]
        public int $adminId,

        public null|int|Optional $transactionId = null,

        #[Required]
        public int $packageId,

        #[Required]
        public int $templateTypeId,

        #[Required]
        #[Min(0)]
        public int $totalCount,

        #[Min(0)]
        public int $usedCount = 0,
    ) {
    }
}
