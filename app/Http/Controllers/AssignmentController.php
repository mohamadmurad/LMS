<?php

namespace App\Http\Controllers;

use App\Helpers\MainHelper;
use App\Models\Assignment;
use App\Models\AssignmentSubmit;
use App\Models\assignmentSubmitObjectives;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Subject $subject)
    {
        $assignments = $subject->assignments()->withCount('submits')->get();

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


    public function submits(Subject $subject, Assignment $assignment)
    {

        $submits = $assignment->submits()->orderBy('status')->get();
        return view('backend.assignmentsSubmits.index', compact('assignment', 'subject', 'submits'));
    }

    public function submitShow(Subject $subject, Assignment $assignment, AssignmentSubmit $submit)
    {

        $objectives = $assignment->module->objectives;

        return view('backend.assignmentsSubmits.show', compact('assignment', 'subject', 'submit','objectives'));
    }
    public function submitMark(Request $request,Subject $subject, Assignment $assignment, AssignmentSubmit $submit)
    {

        $this->validate($request,[
            'mark'=> 'required|numeric|min:0|max:100',
        ]);




        if ($request->has('objective')){
            $objectives = $assignment->module->objectives;
            $achievedObjective = ($request->get('objective'));
            foreach ($objectives as $objective){
                $data = [
                    'objective_id' =>  $objective->id,
                    'submit_id' => $submit->id,
                    'subject_id' => $subject->id,
                ];
                if (array_key_exists($objective->id, $achievedObjective)  ){
                    $data['is_achieved'] = true;

                }else{
                    $data['is_achieved'] = false;

                }
                assignmentSubmitObjectives::create($data);

            }

        }
        $submit->update([
            'mark' => $request->get('mark'),
            'status' => 1,
        ]);

        (new MainHelper)->notify_user([
            'user_id'=>$submit->student_id,
            'message'=>"Your assignment $assignment->name has been marked " ,
            'url'=>"http://example.com",
            'methods'=>['database']
        ]);

       return redirect()->back();
    }
}
