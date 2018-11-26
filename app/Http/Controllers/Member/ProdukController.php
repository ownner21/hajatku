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
use App\Models\ProdukPengiriman;
use File;

class ProdukController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$produks = Produk::where('id_member', Auth::user()->id)->get();
    	$kategoris = Kategori::where('status', 'Tampil')->get();
    	$lokasis = Lokasi::all();
    	return view('member.produk', compact('produks', 'kategoris', 'lokasis'));
    }
    public function store(Request $request)
    {
    	$produk = new Produk;
        $produk->fill($request->all());
    	$produk['id_member'] = Auth::user()->id;
    	$produk->save();

        $stok = new StokProduk;
        $stok['id_produk'] = $produk->id;
        $stok['stok_awal'] = 0;
        $stok['debit'] = $request->stokawal;
        $stok['stok_akhir'] = $request->stokawal;
        $stok['keterangan'] = 'Stok Awal Membuat Produk';
        $stok->save();

    	return redirect('member/produk/edit/'.$produk->id)->with('success', 'Silahkan Melakukan Penambahan Foto Produk');	
    }
    public function edit($id_produk)
    {
    	$produk = Produk::find($id_produk);
    	$produkgambars = ProdukGambar::where('id_produk', $produk->id)->get();
    	$produkpengirimans = ProdukPengiriman::where('id_produk', $produk->id)->get();
    	$kategoris = Kategori::where('status', 'Tampil')->get();
    	$lokasis = Lokasi::all();
    	return view('member.produk-update', compact('produk', 'produkgambars', 'produkpengirimans', 'kategoris', 'lokasis'));
    }
    public function update(Request $request)
    {
    	$produk = Produk::find($request->id);
        $produk->fill($request->all());
    	$produk->update();
    	return redirect('member/produk/id/'.$produk->id)->with('success', 'Berhasil Update Produk');
    }
    public function produkid($id_produk)
    {
    	$produk = Produk::find($id_produk);
    	$produkgambars = ProdukGambar::where('id_produk', $produk->id)->get();
    	$produkpengirimans = ProdukPengiriman::where('id_produk', $produk->id)
					    	->join('lokasis', 'produk_pengirimen.id_lokasi', '=', 'lokasis.id')
					    	->select('wilayah', 'lokasi', 'tagihan')
					    	->get();
    	return view('member.produk-id', compact('produk', 'produkgambars', 'produkpengirimans'));
    }
    public function storegambar(Request $request)
    {

        $files = $request->file('gambar');
        foreach ($files as $file) {
            $filenamewithextension = $file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension =$file->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            $file->move('images/produk',$filenametostorefoto);
           
        	$gambar = new ProdukGambar;
	        $gambar->fill($request->all());
            $gambar['id_produk'] = $request->id_produk;
            $gambar['gambar'] = $filenametostorefoto;
	        $gambar->save();

        }
        return  back()->with('success', 'Berhasil Menambahkan Foto');

    }
    public function hapusgambar($id)
    {
    	$gambar = ProdukGambar::find($id);
        File::delete('images/produk/'.$gambar->gambar);
        $gambar->delete();
        return back()->with('success',' Foto Berhasil Dihapus');
    }

    public function storepengiriman(Request $request)
    {
    	$pengiriman = new ProdukPengiriman;
        $pengiriman->fill($request->all());
        $pengiriman->save();
        return back()->with('success',' Berhasil Menambah Lokasi Pengiriman');
    }
    public function updatepengiriman(Request $request)
    {
    	$pengiriman = ProdukPengiriman::find($request->id);
        $pengiriman->fill($request->all());
        $pengiriman->update();
        return back()->with('success',' Berhasil Mengubah Keterangan Lokasi Pengiriman');
    }
    public function hapuspengiriman($id)
    {
    	ProdukPengiriman::find($id)->delete();
    	return back()->with('success', 'Berhasil Hapus Lokasi');
    }
    public function hapus($id_produk)
    {
    	Produk::where('id_produk', $id_produk)->delete();
    	ProdukPengiriman::where('id_produk', $id_produk)->delete();
    	$gambars = ProdukGambar::where('id_produk', $id_produk)->get();
    	foreach ($gambars as $gambar) {
	        File::delete('images/album/'.$gambar->gambar);
    	}
    	$gambars->delete();
    	return view('member/produk')->with('success', 'Berhasil Hapus Produk');
    }
    public function stokproduk($id_produk)
    {
        $produk = Produk::where('id',$id_produk)->select('nama_produk')->first();
        $stoks = StokProduk::where('id_produk', $id_produk)->orderBy('id','DESC')->get();
        $stokskarang = StokProduk::where('id_produk', $id_produk)->orderBy('id','DESC')->select('stok_akhir')->first();
        return view('member.produk-stok', compact('stoks', 'id_produk', 'stokskarang', 'produk'));
    }
    public function storestok(Request $request)
    {
        $stokawal = StokProduk::where('id_produk', $request->id_produk)->orderBy('id', 'DESC')->select('stok_akhir')->first();
        $stokawal = (!empty($stokawal))? $stokawal->stok_akhir : 0;
        
        $stok = new StokProduk;
        $stok['id_produk'] = $request->id_produk;
        $stok['stok_awal'] = $stokawal;
        $stok['debit'] = $request->debit;
        $stok['stok_akhir'] = $request->debit+$stokawal;
        $stok['keterangan'] = 'Tambah Stok oleh Member';
        $stok->save();

        return back()->with('success', 'Berhasil Tambah Stok');
    }

}
