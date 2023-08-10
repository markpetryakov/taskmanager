<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginReg extends Controller
{
    function login() {
        return view('login');
    }

    function reg() {
        return view('reg');
    }

    function loginPost(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('lists'));
        } 
        return redirect(route('login'))->with('error', 'Please check your Username and Password.');
    }

    function regPost(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $data['username'] = $request->username;
            $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect(route('reg'))->with("error", "Registration failed, try again.");
        }
        return redirect(route('login'));


    }

    function logout () {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
