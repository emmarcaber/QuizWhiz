<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Create/Register Form
    public function create()
    {
        return view('users.register');
    }

    // Show Login Form
    public function login()
    {
        return view('users.login');
    }

    // Logout User
    public function logout(Request $request)
    {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('quizzes.index'))->with('message', 'You have been logged out!');
    }

    // Create New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        // Login User
        auth()->login($user);

        return redirect(route('quizzes.index'))->with('message', 'User created and logged in!');
    }

    // Login User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect(route('quizzes.index'))->with('message', 'You are now logged in!');
        }

        return back()->withErrors([
            'email' => 'Invalid Email and Password'
        ])->onlyInput('email');
    }
}
