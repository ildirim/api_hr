<?php

namespace App\Http\DTOs\Hr\Template\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class QuestionAndOrderRequestDto extends Data
{
    public function __construct(
        public int $id,
        public int|Optional $duration,
        public int $orderNumber = 0,
    ) {
    }
}
