<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subject;
use Illuminate\Http\Request;

class FrontContrller extends Controller
{

    public function home(){
        $subjects = Subject::with('category')->limit(5)->get();
        $categories = Category::all();

        return view('frontend.home',compact('subjects','categories'));
    }

    public function subjects(){
        $subjects = Subject::with('category')->get();
        return view('frontend.subjects',compact('subjects'));
    }
}
