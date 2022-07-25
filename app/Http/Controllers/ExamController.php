<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Exam;
use App\Models\Subject;
use Egulias\EmailValidator\Exception\ExpectingAT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subject $subject)
    {
        $exams = $subject->exams()->withCount('questions')->get();
        return view('backend.exams.index', compact('subject', 'exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subject $subject)
    {
        $modules = $subject->modules;
        $questions = $subject->questions;
        return view('backend.exams.create', compact('subject', 'modules', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Subject $subject)
    {


        $this->validate($request, [
            'name' => 'required|string',
            'count' => 'required|numeric',
            'level' => 'required|in:0,1,2',
            'module_id' => 'required',
            //'question' => 'required|array',
            //  'question.*' => 'required'
        ]);



        $level = $request->get('level');
        $count = $request->get('count');

        if ($level == 0) {
            // easy 90%
            $basic = floor(90 * $count / 100);
        } elseif ($level == 1) {
            // medium 70%
            $basic = floor(70 * $count / 100);
        } else {
            // hard 50%
            $basic = floor(50 * $count / 100);
        }

        $advanced = $count - $basic;

        $questionsIDsBasic = $subject->questions()->whereHas('objective', function ($query) use ($request) {
            $query->where('module_id', $request->get('module_id'));
        })->where('level', 0)->inRandomOrder()->limit($basic)->pluck('id');


        $questionsIDsAdvanced = $subject->questions()->whereHas('objective', function ($query) use ($request) {
            $query->where('module_id', $request->get('module_id'));
        })->where('level', 1)->inRandomOrder()->limit($advanced)->pluck('id');

        //   $questionsIDs = array_keys($request->get('question'));

        DB::beginTransaction();
        try {

            $exam = Exam::create([
                'subject_id' => $subject->id,
                'module_id' => $request->get('module_id'),
                'name' => $request->get('name'),
                'level' => $level,
            ]);

            $this->addPoints($exam, $request->get('exam_points'), 'exam_complete');
            $this->addPoints($exam, $request->get('exam_points_fail'), 'exam_fail');


            $exam->questions()->attach($questionsIDsBasic);
            $exam->questions()->attach($questionsIDsAdvanced);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->route('backend.exams.index', $subject);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Exam $exam)
    {
        return view('backend.exams.show', compact('exam','subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject, Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject, Exam $exam)
    {
        $exam->delete();
        return redirect()->back();
    }
}
