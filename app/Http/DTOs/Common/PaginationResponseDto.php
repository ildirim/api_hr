<?php

namespace App\DTO\Common;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[OA\Schema(title: "Pagination response")]
class PaginationResponseDto extends Data
{
    #[OA\Property]
    #[Computed]
    public bool $has_next_page;
    public function __construct(
        #[OA\Property]
        public object|array $data,
        #[OA\Property]
        public int $total,
        #[OA\Property]
        public ?int $to = 0,
    ) {
        $this->has_next_page = $this->total > $this->to;
    }
}
