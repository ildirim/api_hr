<?php

namespace App\Interfaces\Hr\Template;

use App\Http\DTOs\Hr\Template\Request\TemplateStoreDto;
use App\Http\DTOs\Hr\Template\Request\TemplateStoreUpdateDto;
use App\Http\DTOs\Hr\Template\Request\TemplateQuestionDto;
use App\Http\DTOs\Hr\Template\Request\TemplateSettingDto;
use App\Http\DTOs\Hr\Template\Request\TemplateUpdateDto;
use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;
use Spatie\LaravelData\PaginatedDataCollection;

interface TemplateServiceInterface
{
    public function getTemplatesByCompanyId(): ?PaginatedDataCollection;

    public function getTemplateById(int $id): ?TemplateByIdResponseDto;

    public function store(TemplateStoreDto $templateStoreDto): TemplateByIdResponseDto;

    public function updateQuestions(int $id, TemplateQuestionDto $templateQuestionDto): void;

    public function storeSettings(int $id, TemplateSettingDto $templateSettingDto): void;

    public function destroy(int $id): void;
}
