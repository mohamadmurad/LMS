<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Levels;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontContrller extends Controller
{

    public function home(){
        $subjects = Subject::with('category')->limit(5)->get();
        $categories = Category::all();

        return view('frontend.home',compact('subjects','categories'));
    }

    public function subjects(){
        $subjects = Subject::with('category')->get();
        return view('frontend.subjects.index',compact('subjects'));
    }

    public function subjectInfo(Subject $subject){
        $totalStudent = $subject->enrolledStudents()->count();
     //   $totalPoints = Auth::user()->rewardPointsSubject($subject->id)->sum('count');
//        $level = Auth::user()->getLevel($subject->id);
        $authLevel = null;
//        if ($level) {
//            $authLevel = Levels::findOrFail($level->pivot->level_id);
//        }
//        $lastLevel = Levels::all()->last();
        return view('frontend.subjects.info',compact('subject','totalStudent','authLevel'));
    }
}
