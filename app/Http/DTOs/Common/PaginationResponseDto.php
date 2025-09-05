<?php

namespace App\Http\DTOs\Common;

use Spatie\LaravelData\Data;

class PaginationResponseDto extends Data
{
    public bool $has_next_page;
    public function __construct(
        public object|array $data,
        public int $total,
        public ?int $to = 0,
    ) {
        $this->has_next_page = $this->total > $this->to;
    }
}
