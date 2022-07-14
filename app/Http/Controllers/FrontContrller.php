<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Level;
use App\Models\Levels;
use App\Models\Subject;
use App\Models\SubjectLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontContrller extends Controller
{

    public function home()
    {

        $subjects = Subject::with('category')->limit(5)->get();
        $categories = Category::all();

        return view('frontend.home', compact('subjects', 'categories'));
    }

    public function subjects()
    {
        $subjects = Subject::with('category')->get();
        return view('frontend.subjects.index', compact('subjects'));
    }

    public function subjectInfo(Subject $subject)
    {
        $totalStudent = $subject->enrolledStudents()->count();
        $totalPoints = 0;
        $subject_enroll = null;
        $awardBadges = [];
        if (Auth::check()){
            $totalPoints = Auth::user()->totalPoints($subject->id);
            $subject_enroll = Auth::user()->enrolledSubjectId($subject->id);
            $awardBadges = Auth::user()->rewardBadgesSubject($subject->id)->get();
        }
        $authLevel = null;
        $nextLevel = null;
        $thisLevel = null;
        if ($subject_enroll) {
            $authLevel = Level::findOrFail($subject_enroll->pivot->level_id);
            $thisLevel =SubjectLevel::where('subject_id', $subject->id)->where('level_id',$authLevel->id)->first();
            if ($thisLevel){
                $nextLevel = SubjectLevel::where('subject_id', $subject->id)
                    ->orderBy('point')->where('point', '>',$thisLevel->point)
                    ->where('level_id','!=',$thisLevel->id)->first();
            }


        }







//        $lastLevel = Level::all()->last();





        return view('frontend.subjects.info', compact('subject', 'totalStudent','thisLevel','nextLevel', 'authLevel', 'totalPoints','awardBadges'));
    }

    public function subjectPoints(Subject $subject)
    {
        $authPoints = Auth::user()->rewardPointsSubject($subject->id)->get();
     //   $totalPoints = Auth::user()->rewardPointsSubject($subject->id)->sum('count');
        $totalPoints = Auth::user()->rewardPointsSubject($subject->id)->withSum('point','count')->get()->sum('point_sum_count');

        return view('frontend.points.subjectPoints', compact('subject', 'totalPoints', 'authPoints'));
    }
}
