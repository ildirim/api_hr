<?php

namespace App\Interfaces\Admin\TemplateType;

use App\Http\DTOs\Admin\TemplateType\Request\TemplateTypeRequestDto;
use App\Http\DTOs\Admin\TemplateType\Response\TemplateTypeResponseDto;
use Spatie\LaravelData\DataCollection;

interface TemplateTypeServiceInterface
{
    public function templateTypes(): DataCollection;

    public function templateTypeById(int $id): ?TemplateTypeResponseDto;

    public function store(TemplateTypeRequestDto $request): void;

    public function update(int $id, TemplateTypeRequestDto $request): void;

    public function destroy(int $id): void;
}


