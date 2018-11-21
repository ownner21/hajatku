<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Saldo;
use App\Models\Topup;

class TopupController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$saldomember = Saldo::where(['id_member'=> Auth::user()->id])->orderBy('id', 'DESC')->select('saldo_akhir')->first();
    	$topups = Topup::where('id_member', Auth::user()->id)->get();
    	$saldo = (!empty($saldomember))? $saldomember->saldo_akhir: '0';
    	return view('member.topup', compact('saldo', 'topups'));
    }
    public function store(Request $request)
    {
        $topup = new Topup();
        $topup->fill($request->all());
        $topup['id_member']= Auth::user()->id;
        $topup->save();
        return back()->with('success', 'Berhasil Melakukan Topup silahkan melunasi pada nomor Rekening 812918201289');
    }
}
