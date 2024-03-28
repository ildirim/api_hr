<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hr\JobCategoryController;
use App\Http\Controllers\Hr\QuestionController;
use App\Http\Controllers\Hr\CustomQuestionAnswerController;
use App\Http\Controllers\Hr\CustomQuestionController;
use App\Http\Controllers\Hr\TemplateController;
use App\Http\Controllers\Hr\TemplateCategoryController;

Route::group(['middleware' => ['auth:admin']], function () {
    // job-categories
    Route::controller(JobCategoryController::class)
        ->prefix('job-categories')
        ->group(function () {
            Route::get('', 'jobCategories');
        });

    // questions
    Route::controller(QuestionController::class)
        ->prefix('questions')
        ->group(function () {
            Route::get('shuffle', 'shuffleQuestions');
        });

    // custom questions
    Route::controller(CustomQuestionAnswerController::class)
        ->prefix('custom-question-answer')
        ->group(function () {
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
        });

    // custom questions
    Route::controller(CustomQuestionController::class)
        ->prefix('custom-questions')
        ->group(function () {
            Route::get('/{templateCategoryId}/template-category', 'customQuestionsByTemplateCategoryId');
            Route::get('/{id}', 'customQuestionById');
        });

    // templates
    Route::controller(TemplateController::class)
        ->prefix('templates')
        ->group(function () {
            Route::get('/{id}', 'templateById');
        });

    // template category
    Route::controller(TemplateCategoryController::class)
        ->prefix('template-category')
        ->group(function () {
            Route::post('/store', 'store');
        });
});
