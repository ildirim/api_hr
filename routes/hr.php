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
            Route::get('/{templateId}/template', 'customQuestionsByTemplateId');
            Route::get('/{id}', 'customQuestionById');
        });

    // templates
    Route::controller(TemplateController::class)
        ->prefix('templates')
        ->group(function () {
            Route::get('', 'getTemplatesByCompanyId');
            Route::get('/{id}', 'getTemplateById');
            Route::post('/store', 'store');
            Route::patch('/store/{id}', 'updateStore');
            Route::patch('/store-questions/{id}', 'storeQuestions');
            Route::patch('/update-questions/{id}', 'updateQuestions');
            Route::patch('/store-settings/{id}', 'storeSettings');
            Route::patch('/update-settings/{id}', 'updateSettings');
            Route::patch('/update/{id}', 'update');
        });

    // template category
    Route::controller(TemplateCategoryController::class)
        ->prefix('template-category')
        ->group(function () {
            Route::post('/store', 'store');
        });
});
