<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hr\JobCategoryController;
use App\Http\Controllers\Hr\JobSubcategoryController;
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
            Route::get('', 'getJobCategories');
            Route::get('{jobCategoryId}/job-subcategories', [JobSubcategoryController::class, 'getJobSubcategoriesByCategoryId']);
        });

    // questions
    Route::controller(QuestionController::class)
        ->prefix('questions')
        ->group(function () {
            Route::get('shuffle', 'getShuffledQuestions');
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
            Route::get('', 'getTemplatesByCompanyId');
            Route::get('/{id}', 'getTemplateById');
            Route::post('/store', 'store');
            Route::patch('/store-questions/{id}', 'storeQuestions');
            Route::patch('/update/{id}', 'update');
        });

    // template category
    Route::controller(TemplateCategoryController::class)
        ->prefix('template-category')
        ->group(function () {
            Route::post('/store', 'store');
        });
});
