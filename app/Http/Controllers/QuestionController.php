<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subject $subject)
    {
        $questions = $subject->questions;
        return view('backend.questions.index', compact('subject', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Subject $subject)
    {
        $modules = $subject->modules;
        return view('backend.questions.create', compact('subject', 'modules'));
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
            'question' => 'required|string',
            'level' => 'required|in:0,1',
            'objective_id' => 'required',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'nullable|string',
            'option_4' => 'nullable|string',
            'option_correct' => 'required|min:1|max:4',
        ]);

        DB::beginTransaction();
        try {
            $question = Question::create([
                'question' => $request->get('question'),
                'level' => $request->get('level'),
                'objective_id' => $request->get('objective_id'),
                'subject_id' => $subject->id,
            ]);

            for ($i = 1; $i < 5; $i++) {
                if ($request->get('option_' . $i) != null) {
                    $question->options()->create([
                        'option' => $request->get('option_' . $i),
                        'correct' => $request->get('option_correct') == $i,
                    ]);
                }

            }

            if ($request->hasFile('file')) {
                $question->addMediaFromRequest('file')->toMediaCollection('q_files');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }


        return redirect()->route('backend.questions.index', $subject);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject, Question $question)
    {
        $modules = $subject->modules;
        return view('backend.questions.edit', compact('subject', 'modules', 'question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subject $subject, Question $question)
    {

        $this->validate($request, [
            'question' => 'required|string',
            'level' => 'required|in:0,1',
            'objective_id' => 'required',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'nullable|string',
            'option_4' => 'nullable|string',
            'option_correct' => 'required|min:1|max:4',
        ]);

        DB::beginTransaction();
        try {
            $question->update([
                'question' => $request->get('question'),
                'level' => $request->get('level'),
                'objective_id' => $request->get('objective_id'),
                //  'subject_id' => $subject->id,
            ]);

            $question->options()->delete();
            for ($i = 1; $i < 5; $i++) {
                if ($request->get('option_' . $i) != null) {
                    $question->options()->create([
                        'option' => $request->get('option_' . $i),
                        'correct' => $request->get('option_correct') == $i,
                    ]);
                }
            }

            if ($request->hasFile('file')) {
                if ($question->hasMedia('q_files')) {
                    $question->getFirstMedia('q_files')->delete();
                }
                $question->addMediaFromRequest('file')->toMediaCollection('q_files');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }


        return redirect()->route('backend.questions.index', $subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject, Question $question)
    {
        if ($question->hasMedia('q_files')) {
            $question->getFirstMedia('q_files')->delete();
        }
        $question->delete();
        return redirect()->back();
    }
}
