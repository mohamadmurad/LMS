<?php

namespace App\Http\Controllers;

use App\Events\exam_complete;
use App\Events\exam_fail;
use App\Events\placement_complete;
use App\Helpers\MainHelper;
use App\Models\Exam;
use App\Models\ExamSubmit;
use App\Models\Placement;
use App\Models\PlacementSubmit;
use App\Models\Subject;
use Egulias\EmailValidator\Exception\ExpectingAT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamFrontController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Subject $subject, Exam $exam)
    {
        $options = $request->get('option');


        DB::beginTransaction();
        try {

            $exam_submit = ExamSubmit::create([
                'final_mark' => 0,
                'student_id' => Auth::id(),
                'exam_id' => $exam->id,
            ]);
            $total_questions = count($options);
            $correct_questions = 0;

            if ($request->has('option')) {
                foreach ($options as $q_id => $option) {
                    $question = $exam->questions()->where('questions.id', $q_id)->first();
                    $option = $question->options()->where('id', $option)->first();
                    $isCorrect = $option->correct;
                    $isCorrect ? $correct_questions++ : null;

                    $exam_submit->answers()->attach($question->id, [
                        'option_id' => $option->id,
                        'correct' => $isCorrect,
                    ]);
                }
            }
            $final_mark = 100 * $correct_questions / $total_questions;
            $exam_submit->update([
                'final_mark' => $final_mark,
            ]);

            if ($final_mark >= 60) {
                event(new exam_complete($subject, $exam, $final_mark));
            } else {
                event(new exam_fail($subject, $exam, $final_mark));
            }

            $user = Auth::user();
            (new MainHelper)->notify_user([
                'user_id' => $subject->creator_id,
                'message' => "Student $user->name has been submit Exam $exam->name",
                'url' => "http://example.com",
                'methods' => ['database']
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Subject $subject, Exam $exam)
    {
        $module = $exam->module;
        $modules = $subject->modules;
        $lastSeenObjective = $this->getLastSeenObjective($modules);
        return view('frontend.exam.show', compact('exam', 'subject', 'module', 'lastSeenObjective'));
    }

    public function showPlacement(Subject $subject, Placement $placement)
    {
        // $module = $placement->module;
        $modules = $subject->modules;
        $lastSeenObjective = $this->getLastSeenObjective($modules);
        return view('frontend.placement.show', compact('placement', 'subject', 'lastSeenObjective'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePlacement(Request $request, Subject $subject, Placement $placement)
    {

        $options = $request->get('option');
        DB::beginTransaction();
        try {

            $placement_submit = PlacementSubmit::create([
                'student_id' => Auth::id(),
                'placement_id' => $placement->id,
            ]);


            $correct_questions = 0;

            if ($request->has('option')) {
                foreach ($options as $q_id => $option) {
                    $question = $placement->questions()->where('questions.id', $q_id)->first();
                    $option = $question->options()->where('id', $option)->first();
                    $isCorrect = $option->correct;
                    $isCorrect ? $correct_questions++ : null;

                    $placement_submit->answers()->attach($question->id, [
                        'option_id' => $option->id,
                        'correct' => $isCorrect,
                    ]);

                    if ($isCorrect) {
                        $user = Auth::user();
                        $objective = $question->objective;
                        $this->objectiveSeen($user, $objective, $subject);

                    }
                }
            }


            event(new placement_complete($subject, $placement));
            $user = Auth::user();
            (new MainHelper)->notify_user([
                'user_id' => $subject->creator_id,
                'message' => "Student $user->name has been submit placement $placement->name",
                'url' => "http://example.com",
                'methods' => ['database']
            ]);
            // dd($request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->back();
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
