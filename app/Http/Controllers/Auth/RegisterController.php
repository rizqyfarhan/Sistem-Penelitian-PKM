<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'nrk' => ['required', 'string', 'max:10', 'unique:users,nrk'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:dosen,reviewer,admin'],
        ]);

        if($request->input('role') === 'dosen') {
            $rules['nidn'] = ['required', 'string', 'max:10', 'unique:users,nidn'];
        }

        if ($validator->fails())
        {
            return redirect('register')->withErrors($validator)->withInput();
        }

        $userData = [
            'nrk' => $request->input('nrk'),
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ];

        if ($request->input('role') === 'dosen') {
            $userData['nidn'] = $request->input('nidn');
        }

        $user = User::create($userData);

        auth()->login($user);

        return redirect($this->redirectTo);
    }
}