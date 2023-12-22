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
            return redirect('/upload-proposal-penelitian');
        } elseif ($user->role === 'reviewer') {
            return redirect('/review-proposal-penelitian');
        }
    }

    return back()->withErrors([
        'email' => 'Invalid credentials',
    ])->withInput($request->only('email'));
}

}