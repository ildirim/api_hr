<?php

namespace App\Http\Services\Admin;

use App\Http\DTOs\Admin\EnumData\Request\EnumDataRequestDto;
use App\Http\DTOs\Admin\EnumData\Response\EnumDataResponseDto;
use App\Interfaces\Admin\EnumData\EnumDataRepositoryInterface;
use App\Interfaces\Admin\EnumData\EnumDataServiceInterface;
use App\Interfaces\Admin\EnumType\EnumTypeServiceInterface;
use Spatie\LaravelData\DataCollection;

class EnumDataService implements EnumDataServiceInterface
{
    public function __construct(
        protected EnumDataRepositoryInterface $enumDataRepository,
        protected EnumTypeServiceInterface $enumTypeService,
    )
    {
    }

    public function enumDatas(): DataCollection
    {
        return EnumDataResponseDto::collection($this->enumDataRepository->enumDatas());
    }

    public function enumDataById(int $id): EnumDataResponseDto
    {
        return EnumDataResponseDto::from($this->enumDataRepository->enumDataById($id));
    }

    public function store(EnumDataRequestDto $requestDto): EnumDataResponseDto
    {
        $request = $requestDto->toArray();
        $enumData = $this->enumDataRepository->enumDataByTarget($request['target']);
        if ($enumData) {
            $request['enum_type_id'] = $enumData->enum_type_id;
            $request['code'] = ++$enumData->code;
        } else {
            $enumType = $this->enumTypeService->enumTypeByTarget($request['target']);
            $request['enum_type_id'] = $enumType->id;
            $request['code'] = $enumType->last_number * 1000 + 1;
        }
        return EnumDataResponseDto::from($this->enumDataRepository->store($request));
    }

    public function update(int $id, EnumDataRequestDto $request): EnumDataResponseDto
    {
        return EnumDataResponseDto::from($this->enumDataRepository->update($id, $request->toArray()));
    }

    public function destroy(int $id): EnumDataResponseDto
    {
        return EnumDataResponseDto::from($this->enumDataRepository->destroy($id));
    }
}
