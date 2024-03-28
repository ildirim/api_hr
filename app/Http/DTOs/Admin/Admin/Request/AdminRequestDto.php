<?php

namespace App\Http\DTOs\Admin\Admin\Request;

use App\Http\Enums\ActivationStatusEnum;
use App\Http\Requests\Admin\AdminRequest;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AdminRequestDto extends Data
{
    public function __construct(
        public int $createdAdminId,
        public int $companyId,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public string $phone,
        public ?string $profileImage,
        public int $status,
        public array $roles,
    ) {
    }

    public static function fromRequest(AdminRequest $request): static
    {
        $admin = auth('admin')->user();
        return new self(
            $admin->id,
            $admin->company_id,
            $request->input('firstName'),
            $request->input('lastName'),
            $request->input('email'),
            bcrypt(rand(1111, 999999)),
            $request->input('phone'),
            $request->input('profileImage'),
            ActivationStatusEnum::ACTIVE->value,
            $request->input('roles'),
        );
    }
}
