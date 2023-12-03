<?php

namespace App\Http\Mappers\Admin\Template;

use App\Http\DTOs\Admin\Template\Request\TemplateRequestDto;
use App\Http\DTOs\Admin\Template\Request\TemplateRequestRepositoryDto;
use Illuminate\Support\Facades\Auth;

class TemplateRequestMapper
{
    public static function requestToDto(TemplateRequestDto $requestDto): TemplateRequestRepositoryDto
    {
        $request = $requestDto->toArray();
        $user = Auth::user();
        $request['adminId'] = $user->id;
        if (!isset($request['companyId'])) {
            $request['companyId'] = $user->companies()->value('id');
        }
        return TemplateRequestRepositoryDto::from($request);
    }
}
