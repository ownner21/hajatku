<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\User;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$members = User::all();
    	return view('admin.member', compact('members'));
    }
    public function blok($id)
    {
    	$member = User::find($id);
    	$member['status'] = 'Blok';
    	$member->update();
    	return back()->with('success'. 'Berhasil Blok Member');
    }
    public function aktif($id)
    {
    	$member = User::find($id);
    	$member['status'] = 'Aktif';
    	$member->update();
    	return back()->with('success'. 'Berhasil Aktifkan Member');
    }
}
