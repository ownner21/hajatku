<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$saldos = Saldo::all();
    	$topups = Topup::all();
    	return view('admin.topup', compact('saldos', 'topups'));
    }
    public function lunas($id)
    {
        $topup = Topup::find($id);
        $topup['status']= 'Lunas';
        $topup->update();

        if ($topup) {
            $saldomember = Saldo::where(['id_member'=> $topup->id_member])->orderBy('id', 'DESC')->select('saldo_akhir')->first();
            $saldoawal = (empty($saldomember))? '0': $saldomember->saldo_akhir;
            $saldo = new Saldo;
            $saldo['id_member'] = $topup->id_member;
            $saldo['saldo_awal'] = $saldoawal;
            $saldo['debit'] = $topup->nominal;
            $saldo['saldo_akhir'] = $saldoawal+$topup->nominal;
            $saldo['keterangan'] = 'Nomor Transaksi '.$topup->id. ' Telah berhasil dikonfirmasi';
            $saldo->save();

            if ($saldo) {
                return back()->with('success', 'Berhasil Konfirmasi');
            }
        }
        return back()->with('gagal', 'Gagal Konfirmasi');

    }
    public function gagal($id)
    {
        $topup = Topup::find($id);
        $topup['status']= 'Gagal';
        $topup->update();

        if ($topup) {
            return back()->with('success', 'Berhasil Gagalkan Topup');
        }
        return back()->with('gagal', 'Ini BUG');
    }

}
