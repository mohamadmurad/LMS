<?php

namespace App\Http\Controllers;

use App\Models\Points;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $points = Points::showing()->get();
        return view('backend.points.index', compact('points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.points.create');
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
            'icon' => 'required|image',
            'count' => 'required|numeric',
        ]);

        $point = Points::create([
            'model_type' => 'App\Models\Points',
            'model_id' => 0,
            'name' => $request->get('name'),
            'count' => $request->get('count'),
            'hidden' => 0,
        ]);
        if ($request->hasFile('icon')) {
            $point->addMediaFromRequest('icon')->toMediaCollection('icon');
        }

        return redirect()->route('backend.points.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Points $points
     * @return \Illuminate\Http\Response
     */
    public function show(Points $points)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Points $points
     * @return \Illuminate\Http\Response
     */
    public function edit(Points $points)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Points $points
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Points $points)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Points $points
     * @return \Illuminate\Http\Response
     */
    public function destroy(Points $points)
    {
        //
    }
}
