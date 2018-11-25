<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\ProdukPemesanan;
use App\Models\Paket;
use App\Models\Saldo;
use App\Models\StokProduk;
use App\Models\ProdukPengiriman;
use Carbon\Carbon;
use Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index()
	{
		return view('member.cart');
	}
    public function tambahproduk(Request $request)
    {
        $pengiriman = ProdukPengiriman::where('id',$request->id_pengiriman)->select('id_lokasi', 'tagihan')->first();
    	$produk = Produk::where('id',$request->id_produk)->select('nama_produk','harga')->first();
    	$cart = Cart::add($request->id_produk, $produk->nama_produk, $request->qty, $produk->harga, ['type' => 'Produk', 'id' => $request->id_produk, 'lokasi'=> $pengiriman->id_lokasi, 'biaya'=> $pengiriman->tagihan, 'alamat'=>$request->alamat]);
        // dd($cart);
    	return back()->with('success', 'Berhasil Memasukkan ke Keranjang');
    }
    public function tampilpengiriman($type, $id)
    {
        if ($type == 'produk') {
            $pengirimans = ProdukPengiriman::where('id_produk', $id)->join('lokasis', 'produk_pengirimen.id_lokasi','=','lokasis.id')->select('wilayah','lokasi','id_lokasi','produk_pengirimen.id as id_pengiriman')->get();
        }elseif ($type = 'paket') {
            $pengirimans = PaketPengiriman::where('id_paket', $id)->join('lokasis', 'paket_pengirimen.id_lokasi','=','lokasis.id')->select('wilayah','lokasi','id_lokasi','produk_pengirimen.id as id_pengiriman')->get();
        }
        return $pengirimans;
    }
    public function tampiltagihan($id_pengiriman)
    {
        $tagihan = ProdukPengiriman::where('id',$id_pengiriman)->select('tagihan')->first()->tagihan;
        return $tagihan;
    }
    public function tambahpaket(Request $request)
    {
    	$paket = Paket::find($request->id_produk);
    	Cart::add($id, $paket->nama_paket, 1, $paket->harga, ['type' => 'Paket','id' => $request->id, 'lokasi'=> $request->lokasi, 'biaya'=> $request->biaya]);
    	return back()->with('success', 'Berhasil Memasukkan ke Keranjang');
    }
    public function remove($id)
    {
    	Cart::remove($id);
    	return back()->with('success', 'Berhasil Menghapus dari Keranjang');
    }
    public function removeall()
    {
    	Cart::destroy();
    	return back()->with('success', 'Berhasil Menghapus Semua Isi Keranjang');
    }
    public function lunasi()
    {
        $saldomember = Saldo::where(['id_member'=> Auth::user()->id])->orderBy('id', 'DESC')->select('saldo_akhir')->first();
        //cek saldo mencukupi 
        if (empty($saldomember)) {
           return back()->with('gagal', 'Anda Belum Melakukan TopUp');
        } elseif ($saldomember->saldo_akhir < str_replace(",","",Cart::subtotal())) {
           return back()->with('gagal', 'Saldo Anda Tidak Mencukupi');
        }

        //pengurangan saldo dengan perulangan
    	foreach(Cart::content() as $row){
            $type = $row->options->has('type') ? $row->options->type : '';
            $id = $row->options->has('id') ? $row->options->id : '';
            $lokasi = $row->options->has('lokasi') ? $row->options->lokasi : '';
            $alamat = $row->options->has('alamat') ? $row->options->alamat : '';
            $biayakirim = ProdukPengiriman::find($lokasi);

            if ($type== 'Produk') {
                $produk = Produk::find($id);

                $transaksi = new ProdukPemesanan;
                $transaksi['id_member'] = Auth::user()->id;
                $transaksi['id_penjual'] = $produk->id_member;
                $transaksi['nama_produk'] = $produk->nama_produk;
                $transaksi['produk'] = $produk;
                $transaksi['harga'] = $produk->harga;
                $transaksi['qty'] = $row->qty;
                $transaksi['id_lokasi'] = $lokasi;
                $transaksi['alamat'] = $alamat;
                $transaksi['biaya_kirim'] = $biayakirim->tagihan;
                $transaksi['total_bayar'] = $row->qty*$produk->harga+$biayakirim->tagihan;
                $transaksi['waktu_pesan'] = Carbon::now();
                $transaksi->save();

                // penomoran nomor transaksi
                $nomortransaksi = sprintf("%05d", $transaksi->id);

                //pengurangan saldo
                $saldo = new Saldo;
                $saldo['id_member'] = Auth::user()->id;
                $saldo['saldo_awal'] = $saldomember->saldo_akhir;
                $saldo['kredit'] = $produk->harga+$biayakirim->tagihan;
                $saldo['saldo_akhir'] = $saldomember->saldo_akhir-$produk->harga-$biayakirim->tagihan;
                $saldo['keterangan'] = 'Pengurangan Saldo (Pembelian '.$produk->nama_produk.') ['.$nomortransaksi.']';
                $saldo->save();

                $stokawal = StokProduk::where('id_produk', $id)->orderBy('id', 'DESC')->select('stok_akhir')->first();
                $stokawal = (!empty($stokawal))? $stokawal->stok_akhir : 0;
                
                //pengurangan stok produk
                $stok = new StokProduk;
                $stok['id_produk'] = $id;
                $stok['stok_awal'] = $stokawal;
                $stok['kredit'] = $row->qty;
                $stok['stok_akhir'] = $stokawal-$row->qty;
                $stok['keterangan'] = 'Pengurangan Stok ['.$nomortransaksi.']';
                $stok->save();

            }elseif ($type == 'Paket') {
                dd('Jenis Paket');
            }
        }
        if ($saldo) {
            Cart::destroy();
            return redirect('member')->with('success', 'Berhasil Melakukan Transaksi');
        }
    }
}
