<?php

namespace App\Http\Mappers\Hr\CustomQuestionAnswer;


use App\Http\DTOs\Hr\CustomAnswer\Request\CustomAnswerRequestDto;
use App\Http\DTOs\Hr\CustomQuestion\Request\CustomQuestionRequestDto;
use App\Http\Enums\QuestionTypeEnum;
use Illuminate\Support\Facades\Auth;

class CustomQuestionAnswerRequestMapper
{
    public static function requestToDto($request): array
    {
        $user = Auth::user();
        $customQuestion = new CustomQuestionRequestDto(
            $user->id,
            $user->company_id,
            $request['templateId'],
            $request['languageId'],
            $request['content'],
            QuestionTypeEnum::SINGLE_CHOICE->value
        );
        $answers = [];
        foreach ($request['answers'] as $answer) {
            $answers[] = (
                new CustomAnswerRequestDto(
                    $answer['isCorrect'],
                    $answer['name'],
                )
            );
        }
        return [
            'question' => $customQuestion,
            'answers' => $answers,
        ];
    }
}
