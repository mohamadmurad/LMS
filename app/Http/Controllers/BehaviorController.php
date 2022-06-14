<?php

namespace App\Http\Controllers;

use App\Events\NewBehaviorAdded;
use App\Models\Behavior;
use App\Models\Rules;
use App\Models\StudentBehavior;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $behaviors = Behavior::showing()->get();

        return view('backend.behaviors.index', compact('behaviors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.behaviors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',

        ]);

        Behavior::create(array_merge($request->all(), ['hidden' => 0]));
        return redirect()->route('backend.behaviors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Behavior $behavior
     * @return \Illuminate\Http\Response
     */
    public function show(Behavior $behavior)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Behavior $behavior
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Behavior $behavior)
    {
        return view('backend.behaviors.edit', compact('behavior'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Behavior $behavior
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Behavior $behavior)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $behavior->update($request->all());

        return redirect()->route('backend.behaviors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Behavior $behavior
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Behavior $behavior)
    {
        $behavior->delete();
        return redirect()->back();
    }


    public function addBehaviorToStudent(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'rule_id' => 'required|exists:behaviors,id',
        ]);

        $subject = Subject::where('creator_id', Auth::id())->where('id', $request->get('subject_id'))->first();
        if (!$subject) {
            Session::flash('error', 'Subject Not found');
            return redirect()->back();
        }

        $student = $subject->enrolledStudents()->where('users.id', $request->get('student_id'))->first();
        if (!$student) {
            Session::flash('error', 'Student Not found');
            return redirect()->back();
        }


        $behavior = StudentBehavior::create([
            'user_id' => $request->get('student_id'),
            'behavior_id' => $request->get('rule_id'),
            'subject_id' => $request->get('subject_id'),
        ]);


        event(new NewBehaviorAdded($behavior));
        return redirect()->back();
    }
}
