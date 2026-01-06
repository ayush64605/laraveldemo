<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginprocess(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($request->email == "admin@gmail.com") {
            if ($request->password == '12345') {
                $request->session()->put('userId', 1);
                return redirect()->route('index');
            } else {
                return back()->with('error', 'Password not match!');
            }
        } else {
            return back()->with('error', 'This email is not register.');
        }
    }

    public function logout()
    {
        session()->forget('userId');
        return redirect()->route('login');
    }
}
