<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Produk;
use App\Models\Paket;
use App\Models\Kategori;
use App\Models\ProdukGambar;
use App\Models\ProdukPengiriman;

class MemberController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$kategoris = Kategori::where('status', 'Tampil')->get();
    	$produks = Produk::get();
        $pakets = Paket::get();
    	return view('member.member-dasboard', compact('produks', 'kategoris', 'pakets'));
    }
    public function kategori($kategori)
    {
        $kategori = Kategori::where('slug_kategori', $kategori)->first();
        $kategoris = Kategori::where('status', 'Tampil')->get();
        $produks = Produk::where('id_kategori', $kategori->id )->get();
        $pakets = Paket::get();
        return view('member.member-dasboard', compact('produks', 'kategoris','pakets'));
    }
}
