<?php

use App\Http\Controllers\NotificationsController;
use App\Models\AssignmentSubmit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::get('/ss/{submit}',function (\App\Models\AssignmentSubmit  $submit){
   // dd($submit);
    $response = Http::get('http://localhost:3000',['url'=>$submit->getFirstMediaPath('submit_file')]);
//        dd($response->json());
    $html = $response->json('someData');
    return view('v',compact('html'));
})->name('ss');

Route::middleware('auth')->group(function () {

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/',[NotificationsController::class,'index'])->name('index');
        Route::get('/ajax',[NotificationsController::class,'notifications_ajax'])->name('ajax');
        Route::post('/see',[NotificationsController::class,'notifications_see'])->name('see');
    });


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
        Route::get('subjects/{subject}/students/{student}/exam/{exam}/info', [\App\Http\Controllers\SubjectController::class, 'studentExamInfo'])->name('subjects.student.exam.info');
        Route::get('subjects/{subject}/students/{student}/placement/{placement}/info', [\App\Http\Controllers\SubjectController::class, 'studentPlacementInfo'])->name('subjects.student.placement.info');

        Route::resource('subjects/{subject}/assignments', \App\Http\Controllers\AssignmentController::class);
        Route::get('subjects/{subject}/assignments/{assignment}/submits', [\App\Http\Controllers\AssignmentController::class, 'submits'])->name('assignments.submits');
        Route::get('subjects/{subject}/assignments/{assignment}/submits/{submit}', [\App\Http\Controllers\AssignmentController::class, 'submitShow'])->name('assignments.submits.show');
        Route::post('subjects/{subject}/assignments/{assignment}/submits/{submit}', [\App\Http\Controllers\AssignmentController::class, 'submitMark'])->name('assignments.submits.mark');


        // questions
        Route::resource('subjects/{subject}/questions', \App\Http\Controllers\QuestionController::class);


        // exams
        Route::resource('subjects/{subject}/exams', \App\Http\Controllers\ExamController::class);

        // placement
        Route::resource('placements', \App\Http\Controllers\PlacementController::class);

        Route::resource('students', \App\Http\Controllers\StudentController::class);

        // badges
        Route::resource('badges', \App\Http\Controllers\BadgeController::class);
        Route::resource('badgeBehaviors', \App\Http\Controllers\BadgeBehaviorController::class);

        // levels
        Route::resource('levels', \App\Http\Controllers\LevelController::class);

        // subject levels
        Route::get('subjects/{subject}/levels', [\App\Http\Controllers\SubjectLevelController::class, 'show'])->name('subject.level.show');
        Route::post('subjects/{subject}/levels', [\App\Http\Controllers\SubjectLevelController::class, 'update'])->name('subject.level.update');


        // behaviors
        Route::resource('behaviors', \App\Http\Controllers\BehaviorController::class);


        // student behaviors
        Route::post('studentBehavior', [\App\Http\Controllers\BehaviorController::class, 'addBehaviorToStudent'])->name('studentBehavior.store');

        Route::get('/subjects/{subject}/leaderboard',[\App\Http\Controllers\SubjectController::class,'leaderboard'])->name('subject.leaderboard.show');

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


        Route::get('subject/{subject}/leaderboard',[\App\Http\Controllers\EnrollController::class,'leaderboard'])->name('leaderboard');


        // assignment
        Route::get('subject/{subject}/assignment/{assignment}', [\App\Http\Controllers\EnrollController::class, 'assignment'])->name('subject.assignment');
        Route::post('subject/{subject}/assignment/{assignment}', [\App\Http\Controllers\EnrollController::class, 'assignmentStore'])->name('subject.assignment.store');


        // exam
        Route::get('subject/{subject}/exam/{exam}', [\App\Http\Controllers\ExamFrontController::class, 'show'])->name('subject.exam.show');
        Route::post('subject/{subject}/exam/{exam}', [\App\Http\Controllers\ExamFrontController::class, 'store'])->name('subject.exam.submit');

        // placement
        Route::get('subject/{subject}/placement/{placement}', [\App\Http\Controllers\ExamFrontController::class, 'showPlacement'])->name('subject.placement.show');
        Route::post('subject/{subject}/placement/{placement}', [\App\Http\Controllers\ExamFrontController::class, 'storePlacement'])->name('subject.placement.submit');


        Route::get('subject/{subject}/points', [\App\Http\Controllers\FrontContrller::class, 'subjectPoints'])
            ->name('subject.points');




    });

});


require __DIR__ . '/auth.php';

Route::get('/cccc',function (Request $request){

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
//
//echo 'dfdf';
//




    $stdnum = $request->get('stdnum');
    $city = $request->city;
    $fr3 = $request->fr3;
    $pro = '';
    dd('d');
    if($fr3 == '5' || $fr3 == '6'){ $pro = $_POST['pro']; }



    /* for https://www.3lom4all.com/syria-results/go.php */
    /*
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.3lom4all.com/syria-results/go.php",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "fr3=".$fr3."&mtype=21&city=". $city . "&stdnum=".$stdnum,
      CURLOPT_HTTPHEADER => array(


      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    */
    /* for http://moed.gov.sy/asasy/result.php */

    $url = '';
    if($fr3 =='1'){

        $url = 'http://213.178.255.213/scientific/result.php';


    }else if($fr3 == '2'){

        $url = 'http://213.178.255.213/literary/result.php';

    }else if($fr3 == '3'){

        $url = 'http://213.178.255.213/sharie/result.php';

    }else if($fr3 == '4'){

        $url = 'http://213.178.255.213/trading/result.php';

    }else if($fr3 == '5'){

        $url = 'http://213.178.255.213/feminine/'. $pro .'/result.php';

    }else if($fr3 == '6'){

        $url = 'http://213.178.255.213/industrial/'. $pro .'/result.php';

    }



    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "city=". $city . "&stdnum=".$stdnum,
        CURLOPT_HTTPHEADER => array(


        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


    if ($err) {
        echo "<h5>الرجاء اعادة المحاولة</h5>";
    } else {



        if(strpos($response, 'not found') || !strpos($response, '<div class="col-sm-12 user-row">')){
            echo '<div class="alert alert-danger">الرجاء ادخال معلومات صحيحة</div>';

        }else{

            /*  for  https://www.3lom4all.com/syria-results/go.php */
            /*
                $ss= str_replace("..","https://syad.000webhostapp.com",$response);

                $ss1= str_replace(" http://www.3lom4all.com ","https://www.facebook.com/syrianaddicted/",$ss);

                $ss2= str_replace("https://www.3lom4all.com","https://www.facebook.com/syrianaddicted/",$ss1);


                $fpos = strpos($ss2,'<div  dir="rtl">');

                $ss3 =  substr($ss2,$fpos);


                $tpos = strpos($ss3,'<br>https://www.facebook.com/syrianaddicted/');

                $ss4 =  substr($ss3,0,$tpos-1);

                $t2pos = strrpos($ss4,'</div>');

                $ss5 =  substr($ss4,0,$t2pos-1);





                $t3pos = strpos($ss5,'<div align="center">');

                $ss6 =  substr($ss5,0,$t3pos-1);


                $t4pos = strpos($ss5,'<div class="a-table mark-table">');

                $ss7 =  substr($ss5,$t4pos);

                echo $ss6.''.$ss7;

                */


            /* for http://moed.gov.sy/asasy/result.php */

            $ss= str_replace("..","https://syad.000webhostapp.com",$response);



            $fpos = strpos($ss,'<div class="col-sm-12 user-row">');

            $ss1 =  substr($ss,$fpos);



            $tpos = strpos($ss1,'<div class="col-sm-12 icons-refers">');

            $ss2 =  substr($ss1,0,$tpos-1);

            $ss3= str_replace("https://syad.000webhostapp.com/https://syad.000webhostapp.com","https://syad.000webhostapp.com",$ss2);
            echo $ss3;



        }


    }
});
