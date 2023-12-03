<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Http\DTOs\Admin\EnumType\Request\EnumTypeRequestDto;
use App\Interfaces\Admin\EnumType\EnumTypeRepositoryInterface;
use App\Models\EnumType;
use Illuminate\Support\Collection;

class EnumTypeRepository implements EnumTypeRepositoryInterface
{
    public function __construct(protected EnumType $enumType)
    {
    }

    public function enumTypes(): Collection
    {
        return $this->enumType->get();
    }

    public function countOfEnumTypes(): int
    {
        return $this->enumType->count();
    }

    public function enumTypeById(int $id): EnumType
    {
        $enumType = $this->enumType->find($id);
        if (!$enumType) {
            throw new NotFoundException('Enum növü tapılmadı');
        }
        return $enumType;
    }

    public function enumTypeByTarget(string $target): EnumType
    {
        $enumType = $this->enumType->where('target', $target)
            ->first();
        if (!$enumType) {
            throw new NotFoundException('Enum növü tapılmadı');
        }
        return $enumType;
    }

    public function store(array $request): EnumType
    {
        return $this->enumType->create($request);
    }

    public function update(int $id, array $request): EnumType
    {
        $enumType = $this->enumType->find($id);
        if (!$enumType) {
            throw new NotFoundException('Enum növü tapılmadı');
        }
        $enumType->update($request);
        return $enumType;
    }

    public function destroy(int $id): EnumType
    {
        $enumType = $this->enumType->find($id);
        if (!$enumType) {
            throw new NotFoundException('Enum növü tapılmadı');
        }
        $enumType->delete();
        return $enumType;
    }
}
