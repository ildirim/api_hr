<?php

namespace App\Http\DTOs\Admin\Company\Request;

use App\Http\Requests\Admin\CompanyRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CompanyRequestDto extends Data
{
    public function __construct(
        public int     $adminId,
        public string  $name,
        public string  $phone,
        public ?string $image,
        public ?string $address,
        public ?string $website,
        public ?string $about,
        public ?int    $status,
    )
    {
    }

    public static function fromRequest(CompanyRequest $request): static
    {
        return new self(
            $request->input('adminId'),
            $request->input('name'),
            $request->input('phone'),
            $request->input('image'),
            $request->input('address'),
            $request->input('website'),
            $request->input('about'),
            $request->input('status'),
        );
    }
}
