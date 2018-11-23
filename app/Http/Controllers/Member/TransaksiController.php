<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\Paket;
use App\Models\ProdukPemesanan;

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
    public function transaksiid($id)
    {
    	$transaksi = ProdukPemesanan::find($id);
    	return view('member.transaksi-id', compact('transaksi'));
    }
}
