<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if ($user && \Hash::check($credentials['password'], $user->password)) {
            Session::put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

            return redirect('/admin')->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}