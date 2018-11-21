<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\StokProduk;
use App\Models\ProdukGambar;
use App\Models\Lokasi;
use App\Models\Kategori;
use App\Models\PaketPengiriman;
use App\Models\Paket;
use App\Models\IsiPaket;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$pakets = Paket::where('id_member', Auth::user()->id)->get();
    	$lokasis = Lokasi::all();
    	return view('member.paket', compact('pakets', 'kategoris', 'lokasis'));
    }
    public function store(Request $request)
    {
    	$paket = new Paket;
    	$paket->fill($request->all());
    	$paket['id_member'] = Auth::user()->id;
    	$paket->save();

    	return redirect('member/paket/edit/'.$paket->id)->with('success', 'Berhasil Tambah Paket');
    }
    public function paketid($id_paket)
    {
        $paket = Paket::find($id_paket);
        $isipakets = IsiPaket::where('id_paket', $id_paket)
                    ->join('produks', 'isi_pakets.id_produk', '=', 'produks.id')
                    ->get();
        $ppengirimans = PaketPengiriman::where('id_paket', $id_paket)
                            ->join('lokasis', 'paket_pengirimen.id_lokasi', '=', 'lokasis.id')
                            ->select('wilayah', 'lokasi', 'tagihan')
                            ->get();
        return view('member.paket-id', compact('paket', 'isipakets', 'ppengirimans'));
    }
    public function edit($id_paket)
    {
    	$paket = Paket::find($id_paket);
    	$produks = Produk::where('id_member', Auth::user()->id)->get();
    	$lokasis = Lokasi::all();
    	$isipakets = IsiPaket::where('id_paket', $id_paket)
                    ->join('produks', 'isi_pakets.id_produk', '=', 'produks.id')
                    ->get();
        $ppengirimans = PaketPengiriman::where('id_paket', $id_paket)->get();
    	return view('member.paket-update', compact('paket', 'isipakets', 'produks', 'lokasis','isipakets','ppengirimans'));
    }
    public function update(Request $request)
    {
    	$paket = Paket::find($request->id);
    	$paket->fill($request->all());
    	$paket->update();

    	return back()->with('success', 'Berhasil Update Paket');
    }
    public function storeproduk(Request $request)
    {
    	$isi = new IsiPaket;
    	$isi->fill($request->all());
    	$isi->save();

    	return back()->with('success', 'Berhasil Tambah Produk');
    }
    public function updateproduk(Request $request)
    {
    	$isi = IsiPaket::find($request->id);
    	$isi->fill($request->all());
    	$isi->update();

    	return back()->with('success', 'Berhasil Tambah Produk');
    }
    public function deleteproduk($id)
    {
    	IsiPaket::find($id)->delete();
    	return back()->with('success', 'Berhasil Delete Produk dalam Paket');
    }

    public function storepengiriman(Request $request)
    {
        $pengiriman = new PaketPengiriman;
        $pengiriman->fill($request->all());
        $pengiriman->save();
        return back()->with('success',' Berhasil Menambah Lokasi Pengiriman');
    }
    public function updatepengiriman(Request $request)
    {
        $pengiriman = PaketPengiriman::find($request->id);
        $pengiriman->fill($request->all());
        $pengiriman->update();
        return back()->with('success',' Berhasil Mengubah Keterangan Lokasi Pengiriman');
    }
    public function hapuspengiriman($id)
    {
        PaketPengiriman::find($id)->delete();
        return back()->with('success', 'Berhasil Hapus Lokasi');
    }

    public function delete($id)
    {
    	Paket::find($id)->delete();
    	IsiPaket::find($id)->delete();
        PaketPengiriman::find($id)->delete();
    	return back()->with('success', 'Berhasil Delete Paket');
    }
}
