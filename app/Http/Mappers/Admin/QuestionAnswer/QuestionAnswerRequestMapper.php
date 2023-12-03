<?php

namespace App\Http\Mappers\Admin\QuestionAnswer;


use App\Http\DTOs\Admin\Answer\Request\AnswerRequestDto;
use App\Http\DTOs\Admin\Answer\Request\AnswerTranslationRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionRequestDto;
use App\Http\DTOs\Admin\Question\Request\QuestionTranslationRequestDto;

class QuestionAnswerRequestMapper
{
    public static function requestToDto($request): array
    {
        $questionRequestTranslations = [];
        foreach ($request['translations'] as $translation) {
            $questionRequestTranslations[] = $translation;
        }
        $questions = new QuestionRequestDto(
            $request['jobSubcategoryId'],
            $request['questionCategoryId'],
            $request['questionLevel'],
            $request['period'],
            QuestionTranslationRequestDto::collection($questionRequestTranslations),
        );

        $answers = [];
        foreach ($request['answers'] as $answer) {
            $answerRequestTranslations = [];
            foreach ($answer['translations'] as $translation) {
                $answerRequestTranslations[] = $translation;
            }
            $answers[] = (
                new AnswerRequestDto(
                    $answer['isCorrect'],
                    AnswerTranslationRequestDto::collection($answerRequestTranslations),
                )
            );
        }
        return [
            'questions' => $questions,
            'answers' => $answers,
        ];
    }
}
