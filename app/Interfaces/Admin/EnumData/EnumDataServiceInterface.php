<?php

namespace App\Interfaces\Admin\EnumData;

use App\Http\DTOs\Admin\EnumData\Request\EnumDataRequestDto;
use App\Http\DTOs\Admin\EnumData\Response\EnumDataResponseDto;
use Spatie\LaravelData\DataCollection;

interface EnumDataServiceInterface
{
    public function enumDatas(): DataCollection;

    public function enumDataById(int $id): EnumDataResponseDto;

    public function store(EnumDataRequestDto $request): EnumDataResponseDto;

    public function update(int $id, EnumDataRequestDto $request): EnumDataResponseDto;

    public function destroy(int $id): EnumDataResponseDto;
}
