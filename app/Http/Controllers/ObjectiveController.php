<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Objective;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Subject $subject, Module $module)
    {
        return view('backend.objectives.create', compact('subject', 'module'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Subject $subject, Module $module)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'content' => 'nullable',
            'video' => 'nullable|file',
            'process_points' => 'required|integer',
        ]);
        DB::beginTransaction();
        try {



            $objective = Objective::create([
                'module_id' => $module->id,
                'name' => $request->get('name'),
                'content' => $request->get('content') ?? '',
            ]);

            if ($request->hasFile('video')) {
                $objective->addMediaFromRequest('video')->toMediaCollection('videos');

            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        $this->successFlash('Objective Created Successfully');
        return redirect()->route('backend.modules.index',$subject);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Objective $objective
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Subject $subject,Module $module,Objective $objective)
    {

        return view('backend.objectives.show',compact('subject','module','objective'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Objective $objective
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Subject $subject,Module $module,Objective $objective)
    {
        return view('backend.objectives.edit', compact('subject', 'module','objective'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Objective $objective
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,Subject $subject,Module $module,Objective $objective)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'content' => 'nullable',
            'video' => 'nullable|file',
            'process_points' => 'required|integer',
        ]);

        DB::beginTransaction();
        try {

            $objective->update([
                'name' => $request->get('name'),
                'content' => $request->get('content') ?? $objective->content,
                'type' => $request->get('type') ?? $objective->type,
            ]);

            if ($request->hasFile('video')) {
                if ($objective->hasMedia('videos')) {
                    $subject->getFirstMedia('videos')->delete();
                }
                $objective->addMediaFromRequest('video')->toMediaCollection('videos');

            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        $this->successFlash('Objective Updated Successfully');
        return redirect()->route('backend.modules.index',$subject);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Objective $objective
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject,Module $module,Objective $objective)
    {
        if ($objective->hasMedia('videos')) {
            $subject->getFirstMedia('videos')->delete();
        }
        $subject->delete();
        $this->successFlash('Objective Deleted Successfully');
        return redirect()->back();
    }
}
