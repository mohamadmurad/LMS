<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Subject $subject)
    {
        $assignments = $subject->assignments;
        return view('backend.assignments.index', compact('subject', 'assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create(Subject $subject)
    {
        $modules = $subject->modules;
        return view('backend.assignments.create', compact('subject', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'module_id' => 'required',
            'file' => 'nullable',
        ]);

        $assignment = $subject->assignments()->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'module_id' => $request->get('module_id'),
        ]);

        if ($request->hasFile('file')) {
            $assignment->addMediaFromRequest('file')->toMediaCollection('file');
        }
        $this->successFlash('Assignment Created Successfully');
        return redirect()->route('backend.assignments.index', $subject);
    }

    /**
     * Display the specified resource.
     *
     * @param Assignment $assignment
     * @return Application|Factory|View|Response
     */
    public function show(Subject $subject, Assignment $assignment)
    {
        return view('backend.assignments.show', compact('subject', 'assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Assignment $assignment
     * @return Response
     */
    public function edit(Subject $subject, Assignment $assignment)
    {
        $modules = $subject->modules;
        return view('backend.assignments.edit', compact('subject', 'assignment', 'modules'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Assignment $assignment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subject $subject, Assignment $assignment)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'module_id' => 'required',
            'file' => 'nullable',
        ]);

         $assignment->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'module_id' => $request->get('module_id'),
        ]);

        if ($request->hasFile('file')) {
            if ($assignment->hasMedia('file')) {
                $assignment->getFirstMedia('file')->delete();
            }
            $assignment->addMediaFromRequest('file')->toMediaCollection('file');
        }
        $this->successFlash('Assignment Updated Successfully');
        return redirect()->route('backend.assignments.index', $subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Assignment $assignment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject, Assignment $assignment)
    {
        if ($assignment->hasMedia('file')) {
            $assignment->getFirstMedia('file')->delete();
        }
        $assignment->delete();
        return redirect()->back();
    }
}
