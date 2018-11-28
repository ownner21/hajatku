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
use App\Models\Cart;
use Carbon\Carbon;
use DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index()
	{
        $carts = Cart::where('id_pemesan', Auth::user()->id)
                ->join('produks','carts.id_produk','=','produks.id')
                ->join('produk_pengirimen','carts.id_pengiriman','=','produk_pengirimen.id')
                ->join('lokasis','produk_pengirimen.id_lokasi','=','lokasis.id')
                ->select('produks.nama_produk','produks.harga', 'carts.*','produk_pengirimen.tagihan', 'lokasis.wilayah', 'lokasis.lokasi')
                ->get();
		return view('member.cart', compact('carts', 'harga'));
	}
    public function tambahproduk(Request $request)
    {
        $find = Cart::where(['id_pemesan'=> Auth::user()->id, 'id_produk'=>$request->id_produk, 'id_pengiriman'=>$request->id_pengiriman])->first();
        if (!empty($find)) {
            $produk = Produk::where('id',$request->id_produk)->select('max_pemesanan')->first();
            if ($find->qty+$request->qty <= $produk->max_pemesanan) {
                $find['qty'] = $find->qty+$request->qty;
                $find['alamat'] = $request->alamat;
                $find->update();
            }else{
                return back()->with('gagal', 'Jumlah Maksimum pembelian produk melebihi batas yang ditentukan penjual, <b>Periksa Cart Anda</b>');
            }
        }else{
            $cart = new Cart;
            $cart['id_pemesan'] = Auth::user()->id;
            $cart['id_produk'] = $request->id_produk;
            $cart['qty'] = $request->qty;
            $cart['id_pengiriman'] = $request->id_pengiriman;
            $cart['alamat'] = $request->alamat;
            $cart->save();
        }

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
    	Cart::find($id)->delete();
    	return back()->with('success', 'Berhasil Menghapus dari Keranjang');
    }
    public function removeall()
    {
    	Cart::where('id_pemesan', Auth::user()->id)->delete();
    	return back()->with('success', 'Berhasil Menghapus Semua Isi Keranjang');
    }
    public function lunasi()
    {
        $berhasil = '';
        $gagal = '';
        $saldomember = Saldo::where(['id_member'=> Auth::user()->id])->orderBy('id', 'DESC')->select('saldo_akhir')->first();

        $carts = Cart::where('id_pemesan', Auth::user()->id)
                ->join('produks','carts.id_produk','=','produks.id')
                ->join('produk_pengirimen','carts.id_pengiriman','=','produk_pengirimen.id')
                ->join('lokasis','produk_pengirimen.id_lokasi','=','lokasis.id')
                ->select('produks.nama_produk','produks.harga', 'carts.*','produk_pengirimen.tagihan', 'lokasis.wilayah', 'lokasis.lokasi')
                ->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->harga*$cart->qty+$cart->tagihan;
        }
        //cek saldo mencukupi 
        if (empty($saldomember)) {
           return back()->with('gagal', 'Anda Belum Melakukan TopUp');
        } elseif ($saldomember->saldo_akhir < $total) {
           return back()->with('gagal', 'Saldo Anda Tidak Mencukupi');
        }

        //pengurangan saldo dengan perulangan
    	foreach($carts as $cart){
            if (!empty($cart->id_produk)) {
                $produk = Produk::find($cart->id_produk);
                $stokawal = StokProduk::where('id_produk', $cart->id_produk)->orderBy('id', 'DESC')->select('stok_akhir')->first();

                if ($stokawal->stok_akhir >= $cart->qty) {
                    
                $transaksi = new ProdukPemesanan;
                $transaksi['id_member'] = Auth::user()->id;
                $transaksi['id_penjual'] = $produk->id_member;
                $transaksi['nama_produk'] = $produk->nama_produk;
                $transaksi['produk'] = $produk;
                $transaksi['harga'] = $produk->harga;
                $transaksi['qty'] = $cart->qty;
                $transaksi['id_lokasi'] = $cart->id_pengiriman;
                $transaksi['alamat'] = $cart->alamat;
                $transaksi['biaya_kirim'] = $cart->tagihan;
                $transaksi['total_bayar'] = $cart->harga*$cart->qty+$cart->tagihan;
                $transaksi['waktu_pesan'] = Carbon::now();
                $transaksi->save();

                // penomoran nomor transaksi
                $nomortransaksi = sprintf("%05d", $transaksi->id);

                //pengurangan saldo
                $saldomember = Saldo::where(['id_member'=> Auth::user()->id])->orderBy('id', 'DESC')->select('saldo_akhir')->first();
                $saldo = new Saldo;
                $saldo['id_member'] = Auth::user()->id;
                $saldo['saldo_awal'] = $saldomember->saldo_akhir;
                $saldo['kredit'] = $cart->harga*$cart->qty+$cart->tagihan;
                $saldo['saldo_akhir'] = $saldomember->saldo_akhir-($cart->harga*$cart->qty+$cart->tagihan);
                $saldo['keterangan'] = 'Pengurangan Saldo (Pembelian '.$cart->nama_produk.') ['.$nomortransaksi.']';
                $saldo->save();

                $stokawal = (!empty($stokawal))? $stokawal->stok_akhir : 0;
                
                //pengurangan stok produk
                $stok = new StokProduk;
                $stok['id_produk'] = $cart->id_produk;
                $stok['stok_awal'] = $stokawal;
                $stok['kredit'] = $cart->qty;
                $stok['stok_akhir'] = $stokawal-$cart->qty;
                $stok['keterangan'] = 'Pengurangan Stok ['.$nomortransaksi.']';
                $stok->save();

                Cart::where('id_produk', $cart->id_produk)->delete();

                $berhasil .= 'produk <b>'. $produk->nama_produk.'</b> Berhasil Dilunasi <br>';
                }else{
                    $gagal .= 'produk <b>'. $produk->nama_produk.'</b> gagal melakukan pelunasan, Anda melewatkan moment kesempatan karena stok habis oleh pembeli lain. <br>';
                }
            }elseif (!empty($cart->id_paket)) {
                dd('Jenis Paket');
            }
        }
        if ($saldo) {
            return redirect('member')->with('success', $berhasil)->with('gagal', $gagal);
        }
    }
}
