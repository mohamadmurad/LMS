<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Category;
use App\Models\Exam;
use App\Models\ExamSubmit;
use App\Models\Placement;
use App\Models\RewardPoint;
use App\Models\Rules;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $subjects = Subject::with('category')->paginate();
        } else {
            $subjects = Subject::where('creator_id', Auth::id())->with('category')->with('creator')->paginate();
        }

        return view('backend.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if (!$categories->count()) {
            $this->infoFlash('Please Insert Category before create Subject');
            return redirect()->back();
        }

        return view('backend.subjects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|string',
            'process_points' => 'required|numeric',
            'cover' => 'required|image',
            'category_id' => 'required|exists:categories,id'
        ]);

        DB::beginTransaction();
        try {


            $subject = Subject::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'creator_id' => Auth::id(),
                'category_id' => $request->get('category_id'),
            ]);

            $this->addPoints($subject, $request->get('process_points'), 'enroll_subject');


            if ($request->hasFile('cover')) {
                $subject->addMediaFromRequest('cover')->toMediaCollection('cover');
            }


            DB::commit();


        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        $this->successFlash('Subject Created Successfully');
        return redirect()->route('backend.subjects.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('backend.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $categories = Category::all();

        return view('backend.subjects.edit', compact('subject', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subject $subject)
    {

        // dd( $subject->getFirstMedia('cover'));
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|string',
            'process_points' => 'required|numeric',
            'cover' => 'nullable|image',
            'category_id' => 'required|exists:categories,id'
        ]);

        DB::beginTransaction();
        try {


            $subject->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                //'creator_id' => Auth::id(),
                'category_id' => $request->get('category_id'),
            ]);
            if ($request->hasFile('cover')) {
                $subject->getFirstMedia('cover')->delete();
                $subject->addMediaFromRequest('cover')->toMediaCollection('cover');
            }


            DB::commit();


        } catch (\Exception $e) {

            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->withInput();
        }

        $this->successFlash('Subject Updated Successfully');
        return redirect()->route('backend.subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject)
    {
        if ($subject->hasMedia('cover')) {
            $subject->getFirstMedia('cover')->delete();
        }
        $subject->delete();
        $this->successFlash('Subject Deleted Successfully');
        return redirect()->route('backend.subjects.index');
    }

    public function students(Subject $subject)
    {
        $students = $subject->enrolledStudents;
        $behaviors = Behavior::showing()->get();
        return view('backend.subjects.students.index', compact('subject', 'students', 'behaviors'));
    }


    public function studentInfo(Subject $subject, User $student)
    {
        $authPoints = $student->rewardPointsSubject($subject->id)->get();
        $awardBadges = $student->rewardBadgesSubject($subject->id)->get();
        return view('backend.subjects.students.info', compact('subject', 'student', 'authPoints', 'awardBadges'));
    }

    public function studentExamInfo(Subject $subject, User $student, Exam $exam)
    {

        $submitExam = $exam->userSubmit($student->id)->first();
        return view('backend.subjects.students.examInfo', compact('subject', 'student', 'submitExam'));
    }

    public function studentPlacementInfo(Subject $subject, User $student, Placement $placement)
    {

        $submitExam = $placement->userSubmit($student->id)->first();
        return view('backend.subjects.students.placementInfo', compact('subject', 'student', 'submitExam'));
    }


    public function leaderboard(Subject $subject)
    {

        $students = $subject->getLeaderBoard(Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek());
        $studentMonth = $subject->getLeaderBoard(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth());

        return view('backend.LeaderBoard.index',compact('students','subject','studentMonth'));



    }
}
