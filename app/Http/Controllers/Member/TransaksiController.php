<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\Paket;
use App\Models\ProdukPemesanan;
use App\Models\Saldo;
use Carbon\Carbon;

class TransaksiController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$transaksis = ProdukPemesanan::where('id_member', Auth::user()->id)->orderBy('id','DESC')->get();
    	return view('member.transaksi', compact('transaksis'));
    }
    public function pesan()
    {
        $transaksis = ProdukPemesanan::where('id_member', Auth::user()->id)->where('status', 'Pesan')->orderBy('id','DESC')->get();
        return view('member.transaksi', compact('transaksis'));
    }
    public function konfirmasi()
    {
        $transaksis = ProdukPemesanan::where('id_member', Auth::user()->id)->where('status', 'Konfirmasi')->orderBy('id','DESC')->get();
        return view('member.transaksi', compact('transaksis'));
    }
    public function pengerjaan()
    {
        $transaksis = ProdukPemesanan::where('id_member', Auth::user()->id)->where('status', 'Pengerjaan')->orderBy('id','DESC')->get();
        return view('member.transaksi', compact('transaksis'));
    }
    public function pengiriman()
    {
        $transaksis = ProdukPemesanan::where('id_member', Auth::user()->id)->where('status', 'Pengiriman')->orderBy('id','DESC')->get();
        return view('member.transaksi', compact('transaksis'));
    }
    public function selesai()
    {
        $transaksis = ProdukPemesanan::where('id_member', Auth::user()->id)->where('status', 'selesai')->orderBy('id','DESC')->get();
        return view('member.transaksi', compact('transaksis'));
    }
    public function kembali()
    {
        $transaksis = ProdukPemesanan::where('id_member', Auth::user()->id)->where('status', 'Kembali')->orderBy('id','DESC')->get();
        return view('member.transaksi', compact('transaksis'));
    }

    public function transaksiid($id)
    {
    	$transaksi = ProdukPemesanan::find($id);
    	return view('member.transaksi-id', compact('transaksi'));
    }
    public function konfirmasiselesai($id)
    {
        $penjualan = ProdukPemesanan::find($id);
        $penjualan['waktu_selesai'] = Carbon::now();
        $penjualan['status'] = 'Selesai';
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
        $saldo['keterangan'] = 'Saldo Bertambah Transaksi Berhasil (Pembelian '.$namaproduk.') ['.$nomortransaksi.'] (Tahap 2)';
        $saldo->save();
        return back()->with('success', 'Berhasil Menolak Pemesanan');
        
    }
}
