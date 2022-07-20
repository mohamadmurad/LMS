<?php

namespace App\Http\Controllers;

use App\Models\Placement;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $placements = Placement::all();
        return view('backend.placements.index', compact('placements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();

//        $questions = $subject->questions;
        return view('backend.placements.create', compact('subjects'));
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
            'subject_id' => 'required',
            'question' => 'required|array',
            'question.*' => 'required',
            'points' => 'required',
            'badge_id' => 'nullable',
        ]);

        $questionsIDs = array_keys($request->get('question'));

        DB::beginTransaction();
        try {

            $placement = Placement::create([
                'subject_id' => $request->get('subject_id'),
                'name' => $request->get('name')
            ]);

            $this->addPoints($placement, $request->get('points'), 'placement_complete');
            $this->addbadge($placement, $request->get('badge_id'), 'placement_complete',$request->get('subject_id'));


            $placement->questions()->attach($questionsIDs);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->route('backend.placements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Placement $placement
     * @return \Illuminate\Http\Response
     */
    public function show(Placement $placement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Placement $placement
     * @return \Illuminate\Http\Response
     */
    public function edit(Placement $placement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Placement $placement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Placement $placement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Placement $placement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Placement $placement)
    {
        $placement->delete();

        return redirect()->back();
    }
}
