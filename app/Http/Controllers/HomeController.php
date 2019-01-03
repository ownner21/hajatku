<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\ProdukGambar;
use App\Models\ProdukPengiriman;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()){
            return redirect('member/');
        }
        return view('welcome');
    }
    public function produkid($slug)
    {
        $slug = explode(".",$slug);
        $produk = Produk::where('id', $slug[1])->first();
        $produkgambars = ProdukGambar::where('id_produk', $produk->id)->get();
        $produkpengirimans = ProdukPengiriman::where('id_produk', $produk->id)
                            ->join('lokasis', 'produk_pengirimen.id_lokasi', '=', 'lokasis.id')
                            ->select('wilayah', 'lokasi', 'tagihan')
                            ->get();
        return view('member.produk-slug', compact('produk', 'produkgambars', 'produkpengirimans'));
    }
    public function paketid($id_paket)
    {
        // $paket = Paket::find($id_paket);
        // $isipakets = IsiPaket::where('id_paket', $id_paket)
        //             ->join('produks', 'isi_pakets.id_produk', '=', 'produks.id')
        //             ->get();
        // $ppengirimans = PaketPengiriman::where('id_paket', $id_paket)
        //                     ->join('lokasis', 'paket_pengirimen.id_lokasi', '=', 'lokasis.id')
        //                     ->select('wilayah', 'lokasi', 'tagihan')
        //                     ->get();
        // return view('front.paket-id', compact('paket', 'isipakets', 'ppengirimans'));
    }
}
