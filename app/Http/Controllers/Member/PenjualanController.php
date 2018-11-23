<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\Paket;
use App\Models\Saldo;
use App\Models\ProdukPemesanan;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$penjualans = ProdukPemesanan::where('id_penjual', Auth::user()->id)->orderBy('id','DESC')->get();
    	return view('member.penjualan', compact('penjualans'));
    }
    public function penjualanid($id)
    {
    	$penjualan = ProdukPemesanan::find($id);
    	return view('member.penjualan-id', compact('penjualan'));
    }
    public function konfirmasi($id)
    {
    	$penjualan = ProdukPemesanan::find($id);
    	$penjualan['waktu_konfirmasi'] = Carbon::now();
    	$penjualan['status'] = 'Konfirmasi';
    	$penjualan->save();

    	return back()->with('success', 'Berhasil Konfirmasi Pemesanan');
    }
    public function tidaksiap($id)
    {
    	$penjualan = ProdukPemesanan::find($id);
    	$penjualan['waktu_kembali'] = Carbon::now();
    	$penjualan['status'] = 'Kembali';
    	$penjualan->save();

        $nomortransaksi = sprintf("%05d", $penjualan->id);
        $saldomember = Saldo::where(['id_member'=> $penjualan->id_member])->orderBy('id', 'DESC')->select('saldo_akhir')->first();
        $hargaproduk = $penjualan->total_bayar;
        $namaproduk = (!empty($penjualan->nama_produk))? $penjualan->nama_produk : $penjualan->nama_paket;

    	$saldo = new Saldo;
	    $saldo['id_member'] = $penjualan->id_member;
	    $saldo['saldo_awal'] = $saldomember->saldo_akhir;
	    $saldo['debit'] = $hargaproduk;
	    $saldo['saldo_akhir'] = $saldomember->saldo_akhir+$hargaproduk;
	    $saldo['keterangan'] = 'Pengembalian Saldo penolokan penjual (Pembelian '.$namaproduk.') ['.$nomortransaksi.']';
	    $saldo->save();

    	return back()->with('success', 'Berhasil Menolak Pemesanan');
    }
    public function pengerjaan($id)
    {
    	$penjualan = ProdukPemesanan::find($id);
    	$penjualan['waktu_pengerjaan'] = Carbon::now();
    	$penjualan['status'] = 'Pengerjaan';
    	$penjualan->save();

    	$nomortransaksi = sprintf("%05d", $penjualan->id);
        $saldomember = Saldo::where(['id_member'=> $penjualan->id_penjual])->orderBy('id', 'DESC')->select('saldo_akhir')->first();
        $saldomasuk = $penjualan->total_bayar/2;
        $namaproduk = (!empty($penjualan->nama_produk))? $penjualan->nama_produk : $penjualan->nama_paket;

    	$saldo = new Saldo;
	    $saldo['id_member'] = $penjualan->id_penjual;
	    $saldo['saldo_awal'] = $saldomember->saldo_akhir;
	    $saldo['debit'] = $saldomasuk;
	    $saldo['saldo_akhir'] = $saldomember->saldo_akhir+$saldomasuk;
	    $saldo['keterangan'] = 'Saldo Bertambah Konrimasi Penjualan (Pembelian '.$namaproduk.') ['.$nomortransaksi.'] (Tahap 1)';
	    $saldo->save();
    	return back()->with('success', 'Berhasil Menolak Pemesanan');
	    
    }
}
