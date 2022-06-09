<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{

    protected $repository;
    private $role = 'student';

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('role:Admin')->only(['create', 'store', 'update', 'destroy']);
        $this->repository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $users = $this->repository->all($this->role);
        return view('backend.students.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('backend.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'birthdate' => ['required', 'date'],
        ]);
        $user = $this->repository->create($request->all(), $this->role);
        $this->successFlash('Student Created Successfully');
        return redirect()->route('backend.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(User $student)
    {
        return view('backend.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(User $student)
    {
        return view('backend.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $student)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $student->id],
            'password' => ['nullable', Rules\Password::defaults()],
            'birthdate' => ['required', 'date'],
        ]);
        $this->repository->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => $request->has('password') ? $request->get('password') : $student->password,
            'birthDate' => Carbon::create($request->get('birthdate')),
        ], $student);
        $this->successFlash('Student Updated Successfully');
        return redirect()->route('backend.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $student)
    {
        $this->repository->delete($student);
        $this->successFlash('Student Deleted Successfully');
        return redirect()->route('backend.students.index');
    }
}
