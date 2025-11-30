<?php

namespace App\Http\DTOs\Admin\Package\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Optional;

class PurchasePackageRequestDto extends CoreData
{
    public function __construct(
        #[Required]
        #[Exists('packages', 'id')]
        public int $packageId,

        public null|string|Optional $operationNumber = null,
        public null|string|Optional $gatewayCode = null,
        public null|string|Optional $currency = 'AZN',
    ) {
    }

    public static function messages(): array
    {
        return [
            'packageId.required' => 'Package ID is required',
            'packageId.exists' => 'Package not found',
        ];
    }
}
