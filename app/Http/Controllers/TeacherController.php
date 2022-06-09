<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;

class TeacherController extends Controller
{
    protected $repository;
    private $role = 'teacher';

    public function __construct(UserRepository $userRepository)
    {

        $this->repository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->all($this->role);
        return view('backend.teachers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
            'cert_img' => ['required', 'image'],
        ]);

        $user = $this->repository->create($request->all(), $this->role);
        if ($request->hasFile('cert_img')) {
            $user->addMediaFromRequest('cert_img')->toMediaCollection('certificate');
        }
        $this->successFlash('Teacher Created Successfully');
        return redirect()->route('backend.teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $teacher)
    {
        return view('backend.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $teacher->id],
            'password' => ['nullable', Rules\Password::defaults()],
            'birthdate' => ['required', 'date'],
            'cert_img' => ['nullable', 'image'],
        ]);

        $this->repository->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'birthDate' => Carbon::create($request->get('birthdate')),
            'password' => $request->has('password') ? $request->get('password') : $teacher->password,

        ], $teacher);
        if ($request->hasFile('cert_img')) {
            $teacher->hasMedia('certificate') ? $teacher->getFirstMedia('certificate')->delete(): null;
            $teacher->addMediaFromRequest('cert_img')->toMediaCollection('certificate');
        }
        $this->successFlash('Teacher Updated Successfully');
        return redirect()->route('backend.teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $teacher)
    {
        $teacher->getFirstMedia('certificate')->delete();

        $this->repository->delete($teacher);
        $this->successFlash('Teacher Deleted Successfully');
        return redirect()->route('backend.teachers.index');
    }


    public function verify(User $teacher ){
        $teacher->update([
            'is_verified' => true,
        ]);
        $this->successFlash('Teacher Verified Successfully');
        return back();
    }
}
