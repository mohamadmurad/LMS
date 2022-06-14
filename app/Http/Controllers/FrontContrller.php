<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Level;
use App\Models\Levels;
use App\Models\Subject;
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
        $totalPoints = Auth::user()->rewardPointsSubject($subject->id)->withSum('point','count')->get()->sum('point_sum_count');


        $subject = Auth::user()->enrolledSubjectId($subject->id);

        $authLevel = null;
        if ($subject) {
            $authLevel = Level::findOrFail($subject->pivot->level_id);
        }

        $lastLevel = Level::all()->last();

        return view('frontend.subjects.info', compact('subject', 'totalStudent', 'authLevel', 'lastLevel', 'totalPoints'));
    }

    public function subjectPoints(Subject $subject)
    {
        $authPoints = Auth::user()->rewardPointsSubject($subject->id)->get();
     //   $totalPoints = Auth::user()->rewardPointsSubject($subject->id)->sum('count');
        $totalPoints = Auth::user()->rewardPointsSubject($subject->id)->withSum('point','count')->get()->sum('point_sum_count');

        return view('frontend.points.subjectPoints', compact('subject', 'totalPoints', 'authPoints'));
    }
}
