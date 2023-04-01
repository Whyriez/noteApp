<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function proses_login(Request $request)
    {
        $data =  $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username cannot null',
                'password.required' => 'Password cannot null'
            ]
        );
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'username' => 'Maaf username anda salah',
        ])->onlyInput('username');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function proses_register(Request $request)
    {
        request()->validate(
            [
                'username' => 'required|unique:users|min:3|max:10',
                'password' => 'required|min:5',
                'cpassword' => 'required|same:password',
            ],
            [
                'username.required' => 'Username must be fill',
                'username.unique' => 'Cannot create account, username already exist!',
                'username.min' => 'Username min 3 character',
                'username.max' => 'Username max 10 character',
                'password.required' => 'Password must fill',
                'password.min' => 'Password minimal 5 character',
                'cpassword.required' => 'Confirm Password must fill',
                'cpassword.same' => 'Password and Confirm Password not match',
            ]
        );

        $user = new User([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return redirect()->route('/')->with('success', 'Berhasil Mendaftar');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
