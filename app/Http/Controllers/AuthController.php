<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        if($request->method() == 'GET') {
            if(auth()->check())
                return redirect()->route('dashboard');
            
            return view('auth.login');
        }

        // login action [POST]
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request) {
        if($request->method() == 'GET') {
            if(auth()->check())
                return redirect()->route('dashboard');
            
            return view('auth.register');
        }

        // register action [POST]
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'password_confirm' => ['required']
        ]);

        $user_data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        if($user = User::create($user_data)) {
            // default role: publisher
            $user->assignRole('publisher');
            Auth::login($user);
            //return redirect()->intended('dashboard');
        }


        return back()->withErrors([
            'email' => 'Something went wrong!',
        ]);
    }

    public function logout() {
        Auth::logout(auth()->user());
        return redirect()->route('login');
    }
}
