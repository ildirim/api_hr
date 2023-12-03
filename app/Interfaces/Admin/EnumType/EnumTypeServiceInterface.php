<?php

namespace App\Interfaces\Admin\EnumType;

use App\Http\DTOs\Admin\EnumType\Request\EnumTypeRequestDto;
use App\Http\DTOs\Admin\EnumType\Response\EnumTypeResponseDto;
use Spatie\LaravelData\DataCollection;

interface EnumTypeServiceInterface
{
    public function enumTypes(): DataCollection;

    public function enumTypeById(int $id): EnumTypeResponseDto;

    public function store(EnumTypeRequestDto $request): EnumTypeResponseDto;

    public function update(int $id, EnumTypeRequestDto $request): EnumTypeResponseDto;

    public function destroy(int $id): EnumTypeResponseDto;
}
