<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['logout']);
    }
    public function showLoginForm()
    {
        return view('member.member-login');
    }
    public function register()
    {
        return view('member.member-register');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Attempt to log the user in
        if (Auth::guard('web')->attempt($credential, false)){
            // If login succesful, then redirect to their intended location
            return redirect()->intended(route('member.home'));
        }

        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function store(Request $data)
    {
        Validator::make($data->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ])->validate();

        $member = new User();
        $member->fill($data->all());
        $member['password'] = Hash::make($data['password']);
        $member->save();

        $credential = [
            'email' => $data->email,
            'password' => $data->password
        ];

        if (Auth::guard('web')->attempt($credential, $data)){
            return redirect()->intended(route('member.home'));
        }
        return redirect('/member');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect('/');
    }
}
