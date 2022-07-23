<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class AuthProfile extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $user->id],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'school' => ['nullable', 'string'],
            'new_password' => ['nullable', Rules\Password::defaults()],
        ]);

        $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'gender' => $request->get('gender'),
            'school' => $request->get('school'),
            'birthDate' => Carbon::create($request->get('birthdate')),
        ]);

        if ($request->get('new_password')){
            Auth::user()->update([
                'password' => $request->get('new_password'),
            ]);
        }
        $this->successFlash('Profile Information Updated Successfully');

        return redirect()->back();


    }


}
