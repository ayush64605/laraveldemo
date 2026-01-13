<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerprocess(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email',
            'password' => 'required'
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('login')->with('success', 'Register successfully, Please Login!');
    }
    public function loginprocess(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $request->session()->put('admindata', $admin);
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
        session()->forget('admindata');
        return redirect()->route('login');
    }
}
