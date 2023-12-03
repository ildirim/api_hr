<?php

namespace App\Interfaces\Admin\EnumData;

use App\Models\EnumData;
use Illuminate\Support\Collection;

interface EnumDataRepositoryInterface
{
    public function enumDatas(): Collection;

    public function enumDataById(int $id): EnumData;

    public function store(array $request): EnumData;

    public function update(int $id, array $request): EnumData;

    public function destroy(int $id): EnumData;
}
