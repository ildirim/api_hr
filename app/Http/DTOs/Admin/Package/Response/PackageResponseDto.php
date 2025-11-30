<?php

namespace App\Http\DTOs\Admin\Package\Response;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class PackageResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public $description,
        public float $price,

        #[DataCollectionOf(PackageTemplateTypeResponseDto::class)]
        public ?DataCollection $template_types,
    ) {
        $locale = app()->getLocale();
        $this->description = $this->description[$locale];
    }
}
