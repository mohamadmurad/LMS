<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\PointCustomBehavior;
use App\Models\Points;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointCustomBehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $points = PointCustomBehavior::with(['subject', 'point', 'behavior'])->get();
        } else {

            $subjects = Subject::where('creator_id', Auth::id())->with('creator')->pluck('id');

            $points = PointCustomBehavior::where('subject_id', $subjects)->with(['subject', 'point', 'behavior'])->get();

        }
        return view('backend.pointsBehavior.index', compact('points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $behaviors = Behavior::all();
        $points = Points::showing()->get();

        if (Auth::user()->hasRole('Admin')) {
            $subjects = Subject::with('creator')->get();
        } else {
            $subjects = Subject::where('creator_id', Auth::id())->with('creator')->get();
        }
        return view('backend.pointsBehavior.create', compact('points', 'behaviors', 'subjects'));

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
            'behavior_id' => 'required',
            'point_id' => 'required',
        ]);

        try {
            PointCustomBehavior::create([
                'subject_id' => $request->get('subject_id'),
                'behavior_id' => $request->get('behavior_id'),
                'point_id' => $request->get('point_id'),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('backend.pointsBehavior.index')->with('error', $e->getMessage());
        }


        return redirect()->route('backend.pointsBehavior.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PointCustomBehavior $pointCustomBehavior
     * @return \Illuminate\Http\Response
     */
    public function show(PointCustomBehavior $pointsBehavior)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PointCustomBehavior $pointCustomBehavior
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(PointCustomBehavior $pointsBehavior)
    {
        $behaviors = Behavior::all();
        $points = Points::showing()->get();

        if (Auth::user()->hasRole('Admin')) {
            $subjects = Subject::with('creator')->get();
        } else {
            $subjects = Subject::where('creator_id', Auth::id())->with('creator')->get();
        }
        return view('backend.pointsBehavior.edit', compact('points', 'pointsBehavior', 'behaviors', 'subjects'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PointCustomBehavior $pointCustomBehavior
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PointCustomBehavior $pointsBehavior)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'behavior_id' => 'required',
            'point_id' => 'required',
        ]);

        try {
            $pointsBehavior->update([
                'subject_id' => $request->get('subject_id'),
                'behavior_id' => $request->get('behavior_id'),
                'point_id' => $request->get('point_id'),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('backend.pointsBehavior.index')->with('error', $e->getMessage());
        }


        return redirect()->route('backend.pointsBehavior.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PointCustomBehavior $pointCustomBehavior
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PointCustomBehavior $pointsBehavior)
    {
        $pointsBehavior->delete();
        return redirect()->route('backend.pointsBehavior.index');

    }
}
