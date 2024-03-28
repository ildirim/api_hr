<?php

namespace App\Interfaces\Hr\Template;

use App\Http\DTOs\Hr\Template\Response\TemplateByIdResponseDto;
use Spatie\LaravelData\DataCollection;

interface TemplateServiceInterface
{
    public function templateById(int $id): ?TemplateByIdResponseDto;
}
