<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\EnumTypeController;
use App\Http\Controllers\Admin\EnumDataController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\JobSubcategoryController;
use App\Http\Controllers\Admin\QuestionCategoryController;
use App\Http\Controllers\Admin\QuestionAnswerController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\TestController;

Route::get('/test', [TestController::class, 'index']);
Route::controller(AuthController::class)
    ->group(function () {
        Route::get('profile', 'profile')->middleware(['auth:admin']);
        Route::post('login', 'login');
        Route::get('login/google', 'loginWithGoogle');
        Route::post('register', 'register');
        Route::post('confirm-password', 'confirmPassword');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
});

Route::controller(PasswordResetController::class)
    ->group(function () {
        Route::post('forgot-password', 'forgotPassword');
        Route::post('validate/token', 'validateToken');
        Route::post('validate/otp-code', 'validateOtpCode');
        Route::post('reset-password', 'reset');
    });

Route::group(['middleware' => ['auth:admin']], function () {
    //    admins
    Route::controller(AdminController::class)
        ->prefix('admins')
        ->group(function () {
            Route::get('', 'admins');
            Route::get('/{id}', 'adminById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    languages
    Route::controller(LanguageController::class)
        ->prefix('languages')
        ->group(function () {
            Route::get('', 'languages');
            Route::get('/{id}', 'languageById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    enum type
    Route::controller(EnumTypeController::class)
        ->prefix('enum-types')
        ->group(function () {
            Route::get('', 'enumTypes');
            Route::get('/{id}', 'enumTypeById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    enum data
    Route::controller(EnumDataController::class)
        ->prefix('enum-datas')
        ->group(function () {
            Route::get('', 'enumDatas');
            Route::get('/{id}', 'enumDataById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    roles
    Route::controller(RoleController::class)
        ->prefix('roles')
        ->group(function () {
            Route::get('', 'roles');
            Route::get('/{id}', 'roleById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::put('/update-status/{id}', 'updateStatus');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    permissions
    Route::controller(PermissionController::class)
        ->prefix('permissions')
        ->group(function () {
            Route::get('', 'permissions');
        });

    //    companies
    Route::controller(CompanyController::class)
        ->prefix('companies')
        ->group(function () {
            Route::get('', 'companies');
            Route::get('/{id}', 'companyById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    job categories
    Route::controller(JobCategoryController::class)
        ->prefix('job-categories')
        ->group(function () {
            Route::get('', 'jobCategoriesByLocale');
            Route::get('/{id}', 'jobCategoryById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    job subcategories
    Route::get('job-categories/{jobCategoryId}/job-subcategories', [JobSubCategoryController::class, 'jobSubcategoriesByJobCategoryIdAndLocale']);
    Route::controller(JobSubCategoryController::class)
        ->prefix('job-subcategories')
        ->group(function () {
            Route::get('', 'jobSubcategories');
            Route::get('/{id}', 'jobSubcategoryById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    question categories
    Route::controller(QuestionCategoryController::class)
        ->prefix('question-categories')
        ->group(function () {
            Route::get('', 'questionCategories');
            Route::get('/{id}', 'questionCategoryById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    questions
    Route::controller(QuestionController::class)
        ->prefix('questions')
        ->group(function () {
            Route::get('', 'questions');
            Route::get('/{id}', 'questionById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    question answer
    Route::controller(QuestionAnswerController::class)
        ->prefix('question-answer')
        ->group(function () {
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
        });

    //    answers
    Route::controller(AnswerController::class)
        ->prefix('answers')
        ->group(function () {
            Route::get('', 'answers');
            Route::get('/{id}', 'answerById');
            Route::post('/store', 'store');
            Route::put('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    //    templates
    Route::controller(TemplateController::class)
        ->prefix('templates')
        ->group(function () {
            Route::get('', 'getTemplatesByCompanyId');
            Route::get('/{id}', 'templateById');
            Route::post('/store', 'store');
        });
});
