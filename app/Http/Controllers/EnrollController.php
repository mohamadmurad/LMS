<?php

namespace App\Http\Controllers;

use App\Events\enroll_subject;

use App\Events\objective_complete;
use App\Models\Level;
use App\Models\Objective;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollController extends  Controller
{

    public function enroll(Subject $subject){
        $user = Auth::user();


        //$placement = $subject->exam()->first();
        $placement = null;
        $enroll = $subject->authEnrolledStudent();
        if (!$enroll){
            // new enroll
            $user->enrolledSubject()->attach($subject->id,[
                'level_id' => Level::all()->first()->id,
            ]);


            event(new enroll_subject($user,$subject));


            if (!$placement){
                return redirect()->route('subjects.info', [
                    'subject' => $subject,

                ]);
            }
            return redirect()->route('student.placement.show', [
                'subject' => $subject,
                'placement' => $placement,
            ]);
        }
        if (!$placement){
            return redirect()->route('subjects.info', [
                'subject' => $subject,

            ]);
        }

        return redirect()->route('student.placement.show',[
            'subject' => $subject,
            'placement' => $placement,
        ]);
    }


    public function learn(Subject $subject){
        $modules = $subject->modules;

        $lastSeenObjective = $this->getLastSeenObjective($modules);

        return view('frontend.subjects.learn', compact('subject', 'lastSeenObjective'));
    }


    private function getLastSeenObjective($modules)
    {
        $lastSeenObjective = null;

        foreach ($modules as $index => $module) {
            $objectives = $module->objectives;

            if ($index == 0) {
                $lastSeenObjective = $objectives[0] ?? null;
            }

            //  $temp = $lastSeenObjective;

            foreach ($objectives as $objective) {

                if ($objective->isSeenObj($objective->id)->count() == 0) {
                    return $objective;
                }

            }
//            if ($temp != $lastSeenObjective){
//                break;
//            }

        }

        return $lastSeenObjective;
    }


    public function learnObjective(Subject $subject, Objective $objective){
        $module = $objective->module;
        return view('frontend.objective.learn', compact('subject', 'objective', 'module'));
    }

    public function markObjSeed(Subject $subject, Objective $objective)
    {
        DB::beginTransaction();
        try {

            $user = Auth::user();
            $user->seen()->attach($objective->id);

            event(new objective_complete($user, $objective, $subject));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        $newObjective = Objective::where('id', '>', $objective->id)->where('module_id', $objective->module_id)->min('id');



        if ($newObjective) {
            $newObjective = Objective::findOrFail($newObjective);
            return redirect()->route('student.subject.learnObjective', ['objective' => $newObjective, 'subject' => $subject]);
        }
        $test = $objective->module->exam;
        if ($test) {
            return redirect()->route('student.exam.show', ['module' => $objective->module, 'exam' => $test]);
        }

   //     event(new subject_complete(Auth::user(),$subject));

        return redirect()->route('student.subject.learn', $subject);
    }

}
