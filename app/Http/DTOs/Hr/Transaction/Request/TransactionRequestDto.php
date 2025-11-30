<?php

namespace App\Http\DTOs\Hr\Transaction\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Optional;

class TransactionRequestDto extends CoreData
{
    public function __construct(
        #[Required]
        public int $adminId,

        #[Required]
        public int $packageId,

        #[Required]
        public string $operationNumber,

        public null|string|Optional $gatewayOrder = null,
        public null|string|Optional $gatewayPassword = null,
        public null|string|Optional $gatewayCode = null,

        #[Required]
        public float $amount,

        #[Required]
        public string $currency,

        #[Required]
        public string $type,

        #[Required]
        public string $status,

        public null|array|Optional $response = null,
    ) {
    }
}
