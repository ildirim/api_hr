<?php

namespace App\Http\Repositories\Admin;

use App\Exceptions\NotFoundException;
use App\Interfaces\Admin\EnumData\EnumDataRepositoryInterface;
use App\Models\EnumData;
use Illuminate\Support\Collection;

class EnumDataRepository implements EnumDataRepositoryInterface
{
    public function __construct(protected EnumData $enumData)
    {
    }

    public function enumDatas(): Collection
    {
        return $this->enumData->get();
    }

    public function enumDataById(int $id): EnumData
    {
        $enumData = $this->enumData->find($id);
        if (!$enumData) {
            throw new NotFoundException('Enum məlumat tapılmadı');
        }
        return $enumData;
    }

    public function enumDataByTarget(string $target): ?EnumData
    {
        return $this->enumData->select('ed.id', 'ed.code', 'ed.enum_type_id')
            ->from('enum_datas as ed')
            ->join('enum_types as et', 'et.id', 'ed.enum_type_id')
            ->where('et.target', $target)
            ->orderBy('code', 'DESC')
            ->first();
    }

    public function store(array $request): EnumData
    {
        return $this->enumData->create($request);
    }

    public function update(int $id, array $request): EnumData
    {
        $enumData = $this->enumData->find($id);
        if (!$enumData) {
            throw new NotFoundException('Enum məlumat tapılmadı');
        }
        $enumData->update($request);
        return $enumData;
    }

    public function destroy(int $id): EnumData
    {
        $enumData = $this->enumData->find($id);
        if (!$enumData) {
            throw new NotFoundException('Enum məlumat tapılmadı');
        }
        $enumData->delete();
        return $enumData;
    }
}
