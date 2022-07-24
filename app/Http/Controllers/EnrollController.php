<?php

namespace App\Http\Controllers;

use App\Events\enroll_subject;

use App\Events\objective_complete;
use App\Helpers\MainHelper;
use App\Models\Assignment;
use App\Models\Level;
use App\Models\Objective;
use App\Models\Subject;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{

    public function enroll(Subject $subject)
    {
        $user = Auth::user();

        $placement = $subject->placement;

        $enroll = $subject->authEnrolledStudent();
        if (!$enroll) {
            // new enroll
            $user->enrolledSubject()->attach($subject->id, [
                'level_id' => Level::all()->first()->id,
                'points' => 0,
            ]);
            (new MainHelper)->notify_user([
                'user_id' => $subject->creator_id,
                'message' => "Student $user->name has enroll $subject->name Subject",
                'url' => "http://example.com",
                'methods' => ['database']
            ]);

            event(new enroll_subject($user, $subject));


            if (!$placement) {
                return redirect()->route('subjects.info', [
                    'subject' => $subject,

                ]);
            }
            return redirect()->route('student.subject.placement.show', [
                'subject' => $subject,
                'placement' => $placement,
            ]);
        }
        if (!$placement) {
            return redirect()->route('subjects.info', [
                'subject' => $subject,

            ]);
        }

        return redirect()->route('student.placement.show', [
            'subject' => $subject,
            'placement' => $placement,
        ]);
    }


    public function learn(Subject $subject)
    {
        //    dd($subject->notAchievedObjective());
        $modules = $subject->modules;
        $lastSeenObjective = $this->getLastSeenObjective($modules);
        return view('frontend.subjects.learn', compact('subject', 'lastSeenObjective'));
    }

    public function learnObjective(Subject $subject, Objective $objective)
    {
        $module = $objective->module;
        return view('frontend.objective.learn', compact('subject', 'objective', 'module'));
    }

    public function markObjSeed(Subject $subject, Objective $objective)
    {
        DB::beginTransaction();
        try {

            $user = Auth::user();
            $this->objectiveSeen($user, $objective, $subject);
//            $user->seen()->attach($objective->id);
//            event(new objective_complete($user, $objective, $subject));


            (new MainHelper)->notify_user([
                'user_id' => $subject->creator_id,
                'message' => "Student $user->name has been complete $objective->name",
                'url' => "http://example.com",
                'methods' => ['database']
            ]);

            if ($subject->is_completed) {
                $this->createCertificate($user, $subject);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorFlash($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        $newObjective = Objective::where('id', '>', $objective->id)->where('module_id', $objective->module_id)->min('id');


        if ($newObjective) {
            $newObjective = Objective::findOrFail($newObjective);
            return redirect()->route('student.subject.learnObjective', ['objective' => $newObjective, 'subject' => $subject]);
        }

        $exam = $objective->module->exams()->first();
        if ($exam) {
            return redirect()->route('student.subject.exam.show', ['subject' => $subject, 'exam' => $exam]);
        }

        //     event(new subject_complete(Auth::user(),$subject));

        return redirect()->route('student.subject.learn', $subject);
    }

    public function assignment(Subject $subject, Assignment $assignment)
    {
        $module = $assignment->module;
        $objectives = $assignment->module->objectives;
        return view('frontend.assignments.show', compact('subject', 'module', 'objectives', 'assignment'));
    }

    public function assignmentStore(Request $request, Subject $subject, Assignment $assignment)
    {

        $this->validate($request, [
            'content' => 'required|string',
            'file' => 'nullable',
        ]);

        $submit = $assignment->submits()->create([
            'content' => $request->get('content'),
            'student_id' => Auth::id(),
        ]);

        if ($request->hasFile('file')) {
            $submit->addMediaFromRequest('file')->toMediaCollection('submit_file');
        }
        $user = Auth::user();
        (new MainHelper)->notify_user([
            'user_id' => $subject->creator_id,
            'message' => "Student $user->name has been submit assignment $assignment->name",
            'url' => "http://example.com",
            'methods' => ['database']
        ]);

        $this->successFlash('Submitted');
        return redirect()->back();

    }

    public function leaderboard(Subject $subject)
    {
        $students = $subject->getLeaderBoard(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $studentMonth = $subject->getLeaderBoard(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());

        return view('frontend.LeaderBoard.index', compact('students', 'subject', 'studentMonth'));


    }



}
