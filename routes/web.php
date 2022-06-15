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

Route::get('/', [\App\Http\Controllers\FrontContrller::class, 'home'])->name('home');
Route::get('/subjects', [\App\Http\Controllers\FrontContrller::class, 'subjects'])->name('subjects');
Route::get('/subjects/{subject}', [\App\Http\Controllers\FrontContrller::class, 'subjectInfo'])->name('subjects.info');


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

    Route::group(['prefix' => 'teacher', 'as' => 'backend.', 'middleware' => ['role:teacher|Admin', 'TeacherVerify']], function () {

        Route::post('upload/image', [\App\Http\Controllers\HelperController::class, 'upload_image'])->name('upload.image');


        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard.index');

        Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
        Route::resource('subjects/{subject}/modules', \App\Http\Controllers\ModuleController::class);
        Route::resource('subjects/{subject}/modules/{module}/objectives', \App\Http\Controllers\ObjectiveController::class);
        Route::get('subjects/{subject}/students', [\App\Http\Controllers\SubjectController::class, 'students'])->name('subjects.student');
        Route::get('subjects/{subject}/students/{student}/info', [\App\Http\Controllers\SubjectController::class, 'studentInfo'])->name('subjects.student.info');

        Route::resource('subjects/{subject}/assignments', \App\Http\Controllers\AssignmentController::class);
        Route::get('subjects/{subject}/assignments/{assignment}/submits', [\App\Http\Controllers\AssignmentController::class, 'submits'])->name('assignments.submits');
        Route::get('subjects/{subject}/assignments/{assignment}/submits/{submit}', [\App\Http\Controllers\AssignmentController::class, 'submitShow'])->name('assignments.submits.show');
        Route::post('subjects/{subject}/assignments/{assignment}/submits/{submit}', [\App\Http\Controllers\AssignmentController::class, 'submitMark'])->name('assignments.submits.mark');


        // questions
        Route::resource('subjects/{subject}/questions', \App\Http\Controllers\QuestionController::class);


        // exams
        Route::resource('subjects/{subject}/exams', \App\Http\Controllers\ExamController::class);


        Route::resource('students', \App\Http\Controllers\StudentController::class);

        // badges
        Route::resource('badges', \App\Http\Controllers\BadgeController::class);
        Route::resource('badgeBehaviors', \App\Http\Controllers\BadgeBehaviorController::class);

        // levels
        Route::resource('levels', \App\Http\Controllers\LevelController::class);

        // behaviors
        Route::resource('behaviors', \App\Http\Controllers\BehaviorController::class);


        // student behaviors
        Route::post('studentBehavior', [\App\Http\Controllers\BehaviorController::class, 'addBehaviorToStudent'])->name('studentBehavior.store');


        // points
        Route::resource('points', \App\Http\Controllers\PointsController::class);
        Route::resource('pointsBehavior', \App\Http\Controllers\PointCustomBehaviorController::class);
    });

    Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['auth', 'role:student']], function () {

        Route::get('/student/dashboard', function () {
            dd('rer');
        })->name('dashboard.index');


        Route::post('subject/{subject}/enroll', [\App\Http\Controllers\EnrollController::class, 'enroll'])->name('subject.enroll');
        Route::get('subject/{subject}/learn', [\App\Http\Controllers\EnrollController::class, 'learn'])->name('subject.learn');
        Route::get('subject/{subject}/learn/{objective}', [\App\Http\Controllers\EnrollController::class, 'learnObjective'])->name('subject.learnObjective');
        Route::post('markSeed/{subject}/{objective}', [\App\Http\Controllers\EnrollController::class, 'markObjSeed'])->name('obj.seen');

        // assignment
        Route::get('subject/{subject}/assignment/{assignment}', [\App\Http\Controllers\EnrollController::class, 'assignment'])->name('subject.assignment');
        Route::post('subject/{subject}/assignment/{assignment}', [\App\Http\Controllers\EnrollController::class, 'assignmentStore'])->name('subject.assignment.store');


        Route::get('subject/{subject}/points', [\App\Http\Controllers\FrontContrller::class, 'subjectPoints'])
            ->name('subject.points');

    });

});


require __DIR__ . '/auth.php';
