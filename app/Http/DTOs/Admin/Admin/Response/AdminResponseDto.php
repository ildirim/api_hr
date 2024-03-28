<?php

namespace App\Http\DTOs\Admin\Admin\Response;

use App\Http\DTOs\Admin\Role\Response\RoleResponseDto;
use App\Models\Admin;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class AdminResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public int $created_admin_id,
        public string $first_name,
        public string $last_name,
        public ?string $email,
        public ?string $phone,
        public ?string $profile_image,
        public int $status,
        public ?string $created_at,
        #[DataCollectionOf(RoleResponseDto::class)]
        public ?Collection $roles,
    ) {
    }

    public static function fromModel(Admin $admin): self
    {
        return new self(
            $admin->id,
            $admin->created_admin_id,
            $admin->first_name,
            $admin->last_name,
            $admin->email,
            $admin->phone,
            $admin->profile_image,
            $admin->status,
            $admin->created_at,
            $admin->roles
        );
    }
}
