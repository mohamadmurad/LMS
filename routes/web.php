<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {


    Route::group(['prefix' => 'teacher', 'as' => 'backend.', 'middleware' => ['role:Admin']], function () {

        Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    });


    Route::group(['prefix' => 'teacher', 'as' => 'backend.', 'middleware' => ['role:teacher|Admin']], function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard.index');

        Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
    });

    Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['auth', 'role:student']], function () {

        Route::get('/student/dashboard', function () {
            dd('rer');
        })->name('dashboard.index');
    });

});


require __DIR__ . '/auth.php';
