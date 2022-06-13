<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Rules;
use Illuminate\Http\Request;

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
}
