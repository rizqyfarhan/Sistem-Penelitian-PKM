<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function indexProfile() 
    {
        $role = Auth::user()->role;

        return view('profile', compact('role'));
    }
}