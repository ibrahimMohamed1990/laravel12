<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
     public function login() {
            return view('auth.login');
        }

     public function authenticate( Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]) ;

        if (auth()->attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.', 
        ])->onlyInput('email');

    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
