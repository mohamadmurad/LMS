<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'status' => ['required', 'in:1,0'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthdate' => ['required', 'date'],
            'cert_img' => ['required_if:status,1', 'image'],
        ]);


        DB::beginTransaction();
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birthDate' => Carbon::create($request->birthdate),
            ]);

            if ($request->get('status') == 0) {
                $user->update(['is_verified' => 1]);
                $user->syncRoles(['student']);
            } else {

                $user->syncRoles(['teacher']);
                if ($request->hasFile('cert_img')) {
                    //$user->hasMedia('certificate') ? $teacher->getFirstMedia('certificate')->delete(): null;
                    $user->addMediaFromRequest('cert_img')->toMediaCollection('certificate');
                }
            }
            event(new Registered($user));

            Auth::login($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            $this->errorFlash($e->getMessage());
            return redirect()->back();
        }


        if ($request->get('status') == 0) {
            return redirect()->route('home');
        } else {

            return redirect(RouteServiceProvider::HOME);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
