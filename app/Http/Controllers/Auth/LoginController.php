<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->role === 'dosen') {
            return redirect('/penelitian');
        } else if ($user->role === 'reviewer') {
            return redirect('/review-proposal-penelitian');
        } else if ($user->role === 'admin') {
            return redirect('/admin');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau Password Salah',
    ])->withInput($request->only('email'));
}

}