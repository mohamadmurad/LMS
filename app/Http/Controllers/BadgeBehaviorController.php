<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\BadgeBehavior;
use App\Models\Behavior;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadgeBehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {

            $badges = BadgeBehavior::with(['subject', 'badge', 'behavior'])->get();
        } else {

            $subjects = Subject::where('creator_id', Auth::id())->with('creator')->pluck('id');

            $badges = BadgeBehavior::whereIn('subject_id', $subjects)->with(['subject', 'badge', 'behavior'])->get();

        }
        return view('backend.badgeBehaviors.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $behaviors = Behavior::where('hidden',0)->get();
        $badges = Badge::all();

        if (Auth::user()->hasRole('Admin')) {
            $subjects = Subject::with('creator')->get();
        } else {

            $subjects = Subject::where('creator_id', Auth::id())->with('creator')->get();
        }
        return view('backend.badgeBehaviors.create', compact('badges', 'behaviors', 'subjects'));

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
            'subject_id' => 'required',
            'rule_id' => 'required',
            'badge_id' => 'required',
        ]);

        try {
            BadgeBehavior::create([
                'subject_id' => $request->get('subject_id'),
                'behavior_id' => $request->get('rule_id'),
                'badge_id' => $request->get('badge_id'),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('backend.badgeBehaviors.index')->with('error', $e->getMessage());
        }


        return redirect()->route('backend.badgeBehaviors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param BadgeBehavior $badgeBehavior
     * @return \Illuminate\Http\Response
     */
    public function show(BadgeBehavior $badgeBehavior)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BadgeBehavior $badgeBehavior
     * @return Factory|Application|View
     */
    public function edit(BadgeBehavior $badgeBehavior)
    {
        $behaviors = Behavior::all();
        $badges = Badge::all();

        if (Auth::user()->hasRole('Admin')) {
            $subjects = Subject::with('creator')->get();
        } else {
            $subjects = Subject::where('creator_id', Auth::id())->with('creator')->get();
        }
        return view('backend.badgeBehaviors.edit', compact('badges', 'badgeBehavior', 'behaviors', 'subjects'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param BadgeBehavior $badgeBehavior
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BadgeBehavior $badgeBehavior)
    {

        $this->validate($request, [
            'subject_id' => 'required',
            'rule_id' => 'required',
            'badge_id' => 'required',
        ]);

        try {
            $badgeBehavior->update([
                'subject_id' => $request->get('subject_id'),
                'behavior_id' => $request->get('rule_id'),
                'badge_id' => $request->get('badge_id'),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('backend.badgeBehaviors.index')->with('error', $e->getMessage());
        }


        return redirect()->route('backend.badgeBehaviors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BadgeBehavior $badgeBehavior
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BadgeBehavior $badgeBehavior)
    {
        $badgeBehavior->delete();
        return redirect()->route('backend.badgeBehaviors.index');
    }
}
