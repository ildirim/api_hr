<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/google/redirect',
    [\App\Http\Controllers\Admin\AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/test', function () {
    return view('welcome');
});
