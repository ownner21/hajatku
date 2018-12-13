<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Mail;
use Crypt;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->except(['logout']);
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
        if (Auth::guard()->attempt($credential, $credential)){
            // If login succesful, then redirect to their intended location
            if (Auth::user()->status == "Blok") {
                Auth::guard()->logout();
                return redirect('member/login')->with('gagal','Status member anda telah diblock oleh admin ');
            }
             if (Auth::user()->status == "Daftar") {
                Auth::guard()->logout();
                return redirect('member/login')->with('gagal','Anda Belum Verifikasi Email, Cek Email Anda!!');
            }
            return redirect()->intended(route('member.home'));
        }

        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('gagal','Email atau Passsword Tidak Sesuai');
    }
    public function store(Request $data)
    {
        Validator::make($data->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed|alpha_num',
        ])->validate();

        $member = new User();
        $member->fill($data->all());
        $member['status'] = 'Daftar';
        $member['password'] = Hash::make($data['password']);
        $member->save();

        $credential = [
            'email' => $data->email,
            'password' => $data->password
        ];

        Mail::to($member->email)->send(new VerifyEmail($member));
        // if (Auth::guard()->attempt($credential, $data)){
        //     return redirect()->intended(route('member.home'));
        // }
        
        return redirect('/member/login')->with('success', 'Berhasil Daftar Silahkan Cek Email untuk melakukan Verifikas data');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect('/');
    }
    public function verify()
    {
        if (empty(request('token'))) {
            // if token is not provided
            return redirect()->route('member.register')->with('gagal', 'Gagal Verifikasi Email Cek kembali Email Anda');
        }
        // decrypt token as email
        $decryptedEmail = Crypt::decrypt(request('token'));
        // find user by email
        $user = User::whereEmail($decryptedEmail)->first();
        if ($user->status == 'Aktif') {
            // user is already active, do something
        }
        // otherwise change user status to "activated"
        $user->status = 'Aktif';
        $user->update();
        // autologin
        // Auth::loginUsingId($user->id);
        return redirect('/member/login')->with('success', 'Berhasil Verifikasi Email, Silahkan Login');
    }
}
