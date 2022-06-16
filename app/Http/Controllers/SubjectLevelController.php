<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subject;
use App\Models\SubjectLevel;
use Illuminate\Http\Request;

class SubjectLevelController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param \App\Models\SubjectLevel $subjectLevel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Subject $subject, SubjectLevel $subjectLevel)
    {
        $levels = Level::all();
        return view('backend.subjectLevel.show', compact('subject', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SubjectLevel $subjectLevel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subject $subject)
    {

        foreach ($request->get('minPoint') as $level => $point) {
            $subject->levels()->syncWithoutDetaching([
                $level => [
                    'point' => $point,
                ]


            ]);
        }

        return redirect()->back();

    }


}
