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
            'nrk' => 'required|string|max:10',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('nrk', 'password');

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
            'nrk' => 'NRK atau Password Salah',
        ])->withInput($request->only('nrk'));
    }
}