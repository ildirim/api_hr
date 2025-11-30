<?php

namespace App\Http\DTOs\Admin\Package\Request;

use App\Http\DTOs\CoreData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class PackageRequestDto extends CoreData
{
    public function __construct(
        #[Required]
        #[Min(3)]
        #[Max(255)]
        public string $name,

        public null|array|Optional $description = null,

        #[Required]
        #[Min(0)]
        public float $price,

        #[Required]
        #[DataCollectionOf(PackageTemplateTypeDto::class)]
        public DataCollection $templateTypes,
    ) {
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Package name is required',
            'name.min' => 'Package name must be at least 3 characters',
            'name.max' => 'Package name cannot exceed 255 characters',
            'price.required' => 'Price is required',
            'price.min' => 'Price cannot be negative',
            'templateTypes.required' => 'At least one template type is required',
        ];
    }
}
