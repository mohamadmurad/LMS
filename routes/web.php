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


        Route::resource('teachers', \App\Http\Controllers\TeacherController::class);
        Route::resource('admins', \App\Http\Controllers\AdminController::class);
        Route::get('techVerify/{teacher}', [\App\Http\Controllers\TeacherController::class, 'verify'])->name('teachers.verify');



    });

    Route::get('teacher/notVerified', function () {
        return view('backend.teachers.notVerified');
    })->name('backend.teacher.notVerified')->middleware(['notVerified']);

    Route::group(['prefix' => 'teacher', 'as' => 'backend.', 'middleware' => ['role:teacher|Admin','TeacherVerify']], function () {

        Route::post('upload/image', [\App\Http\Controllers\HelperController::class, 'upload_image'])->name('upload.image');




        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard.index');

        Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
        Route::resource('subjects/{subject}/modules', \App\Http\Controllers\ModuleController::class);
        Route::resource('subjects/{subject}/modules/{module}/objectives', \App\Http\Controllers\ObjectiveController::class);

        Route::resource('students', \App\Http\Controllers\StudentController::class);
    });

    Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['auth', 'role:student']], function () {

        Route::get('/student/dashboard', function () {
            dd('rer');
        })->name('dashboard.index');
    });

});


require __DIR__ . '/auth.php';
