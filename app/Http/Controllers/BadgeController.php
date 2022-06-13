<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::all();
        return view('backend.badges.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.badges.create');
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

        $badge = Badge::create([
            'name' => $request->get('name'),
        ]);
        if ($request->hasFile('icon')) {
            $badge->addMediaFromRequest('icon')->toMediaCollection('icon');
        }


        return redirect()->route('backend.badges.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Badge $badge)
    {
        return view('backend.badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Badge $badge)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'icon' => 'nullable|image',

        ]);

        $badge->update([
            'name' => $request->get('name'),
        ]);
        if ($request->hasFile('icon')) {
            $badge->getFirstMedia('icon')->delete();
            $badge->addMediaFromRequest('icon')->toMediaCollection('icon');
        }

        return redirect()->route('backend.badges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Badge $badge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Badge $badge)
    {
        if ($badge->hasMedia('icon')) {
            $badge->getFirstMedia('icon')->delete();
        }
        $badge->delete();
        return redirect()->back();
    }
}
