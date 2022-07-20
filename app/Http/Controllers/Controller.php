<?php

namespace App\Http\Controllers;

use App\Events\objective_complete;
use App\Models\Badge;
use App\Models\Behavior;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function errorFlash($msg='Error'){
        Session::flash('error',$msg);
    }

    public function successFlash($msg='Success !'){
        Session::flash('success',$msg);
    }

    public function infoFlash($msg='Info !'){
        Session::flash('info',$msg);
    }


    public function addPoints($model,$count,$behavior){
        // insert exam_points points
        $point =  $model->points()->create([
            'count' => $count,
        ]);
        $exam_complete = Behavior::where('name',$behavior)->first()->id;
        $point->behavior()->attach($exam_complete);
    }

    public function addbadge($model,$badge_id,$behavior,$subject_id){
        $badge = Badge::findOrFail($badge_id);
        $exam_complete = Behavior::where('name',$behavior)->first()->id;
        $badge->behavior()->attach($exam_complete,[
            'subject_id' => $subject_id
        ]);
    }

    protected function getLastSeenObjective($modules)
    {

        $lastSeenObjective = null;

        foreach ($modules as $index => $module) {
            $objectives = $module->objectives;

            if ($index == 0) {
                $lastSeenObjective = $objectives[0] ?? null;
            }

            foreach ($objectives as $objective) {

                if ($objective->isSeenObj($objective->id)->count() == 0) {
                    return $objective;
                }
            }
        }

        return $lastSeenObjective;
    }

    public function objectiveSeen($user,$objective,$subject){
      //  dd($user->seen);
       $isSeen =  $user->seen()->where('objective_seen.student_id',$user->id)
            ->where('objective_seen.objective_id',$objective->id)->first();

       if (!$isSeen){
           $user->seen()->attach($objective->id);
           event(new objective_complete($user, $objective, $subject));
       }

    }
}
