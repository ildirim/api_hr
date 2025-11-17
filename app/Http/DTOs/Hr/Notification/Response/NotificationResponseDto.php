<?php

namespace App\Http\DTOs\Hr\Notification\Response;

use App\Helpers\CommonHelper;
use Spatie\LaravelData\Attributes\Hidden;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class NotificationResponseDto extends Data
{
    #[Computed]
    public string $message;

    public function __construct(
        public string $id,
        #[Hidden]
        public array $data,
        public ?string $read_at,
        public string $created_at,
    ) {
        $this->message = $data['messages'][app()->getLocale()];
    }
}


