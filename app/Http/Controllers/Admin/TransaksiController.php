<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$transaksis = ProdukPemesanan::orderBy('id','DESC')->get();
    	return view('admin.transaksi', compact('transaksis'));
    }
    public function transaksiid($id)
    {
        $transaksi = ProdukPemesanan::find($id);
        return view('admin.transaksi-id', compact('transaksi'));
    }
}
