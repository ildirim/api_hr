<?php

namespace App\Interfaces\Admin\EnumType;

use App\Models\EnumType;
use Illuminate\Support\Collection;

interface EnumTypeRepositoryInterface
{
    public function enumTypes(): Collection;

    public function enumTypeById(int $id): EnumType;

    public function store(array $request): EnumType;

    public function update(int $id, array $request): EnumType;

    public function destroy(int $id): EnumType;
}
