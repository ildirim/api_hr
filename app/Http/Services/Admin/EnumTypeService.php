<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\EnumType\Request\EnumTypeRequestDto;
use App\Http\DTOs\Admin\EnumType\Response\EnumTypeResponseDto;
use App\Interfaces\Admin\EnumType\EnumTypeRepositoryInterface;
use App\Interfaces\Admin\EnumType\EnumTypeServiceInterface;
use Spatie\LaravelData\DataCollection;

class EnumTypeService implements EnumTypeServiceInterface
{
    public function __construct(protected EnumTypeRepositoryInterface $enumTypeRepository)
    {
    }

    public function enumTypes(): DataCollection
    {
        return EnumTypeResponseDto::collection($this->enumTypeRepository->enumTypes());
    }

    public function enumTypeById(int $id): EnumTypeResponseDto
    {
        return EnumTypeResponseDto::from($this->enumTypeRepository->enumTypeById($id));
    }

    public function enumTypeByTarget(string $target): EnumTypeResponseDto
    {
        return EnumTypeResponseDto::from($this->enumTypeRepository->enumTypeByTarget($target));
    }

    public function store(EnumTypeRequestDto $requestDto): EnumTypeResponseDto
    {
        $request = $requestDto->toArray();
        $request['last_number'] = $this->enumTypeRepository->countOfEnumTypes() + 1;
        return EnumTypeResponseDto::from($this->enumTypeRepository->store($request));
    }

    public function update(int $id, EnumTypeRequestDto $request): EnumTypeResponseDto
    {
        return EnumTypeResponseDto::from($this->enumTypeRepository->update($id, $request->toArray()));
    }

    public function destroy(int $id): EnumTypeResponseDto
    {
        return EnumTypeResponseDto::from($this->enumTypeRepository->destroy($id));
    }
}
