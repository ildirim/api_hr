<?php

namespace App\Http\Mappers\Hr\TemplateCategoryQuestion;

use App\Http\DTOs\Hr\TemplateCategoryQuestion\Request\TemplateCategoryQuestionRequestDto;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\DataCollection;

class TemplateCategoryQuestionRequestMapper
{
    public static function questionRequestToDto(array $questionIds): DataCollection
    {
        $user = Auth::user();
        $request = [];
        foreach ($questionIds as $questionId) {
            $request[] = [
                'question_id' => $questionId,
                'custom_question_id' => null,
                'company_id' => $user->companies()->value('id'),
            ];
        }
        return TemplateCategoryQuestionRequestDto::collection($request);
    }
    public static function customQuestionRequestToDto(array $customQuestionIds): DataCollection
    {
        $user = Auth::user();
        $request = [];
        foreach ($customQuestionIds as $customQuestionId) {
            $request[] = [
                'question_id' => null,
                'custom_question_id' => $customQuestionId,
                'company_id' => $user->companies()->value('id'),
            ];
        }
        return TemplateCategoryCustomQuestionRequestDto::collection($request);
    }
}
