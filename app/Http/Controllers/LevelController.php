<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();
        return view('backend.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.levels.create');
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

        ]);

        $level = Level::create([
            'name' => $request->get('name'),
        ]);
        if ($request->hasFile('icon')) {
            $level->addMediaFromRequest('icon')->toMediaCollection('icon');
        }


        return redirect()->route('backend.levels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Level $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Level $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('backend.levels.edit', compact('level'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Level $level
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Level $level)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'icon' => 'nullable|image',

        ]);

        $level->update([
            'name' => $request->get('name'),
        ]);
        if ($request->hasFile('icon')) {
            $level->getFirstMedia('icon')->delete();
            $level->addMediaFromRequest('icon')->toMediaCollection('icon');
        }

        return redirect()->route('backend.levels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Level $level
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Level $level)
    {
        if ($level->hasMedia('icon')) {
            $level->getFirstMedia('icon')->delete();
        }
        $level->delete();
        return redirect()->back();
    }
}
