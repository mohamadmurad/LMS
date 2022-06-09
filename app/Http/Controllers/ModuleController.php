<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Module;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Subject $subject)
    {
        $modules = $subject->modules()->get();
        return view('backend.modules.index', compact('subject', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Subject $subject)
    {
        return view('backend.modules.create', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Subject $subject
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        $subject->modules()->create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        $this->successFlash('Module Created Successfully');

        return redirect()->route('backend.modules.index', $subject);
    }

    /**
     * Display the specified resource.
     *
     * @param Module $module
     * @return Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     * @return Application|Factory|View
     */
    public function edit(Subject $subject, Module $module)
    {
        return view('backend.modules.edit', compact('subject', 'module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Module $module
     * @return RedirectResponse
     */
    public function update(Request $request, Subject $subject, Module $module)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        $module->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        $this->successFlash('Module Updated Successfully');

        return redirect()->route('backend.modules.index', $subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     * @return RedirectResponse
     */
    public function destroy(Subject $subject, Module $module)
    {
        $module->delete();
        $this->successFlash('Module Deleted Successfully');
        return redirect()->route('backend.modules.index', $subject);
    }
}
