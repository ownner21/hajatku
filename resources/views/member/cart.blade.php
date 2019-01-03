@extends('member.member-template')

@section('content')
  <div class="row">
    @if (session('success'))
      <div class="col-sm-12">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      </div>
    @endif
    @if (session('gagal'))
      <div class="col-sm-12">
        <div class="alert alert-danger">
            {{ session('gagal') }}
        </div>
      </div>
    @endif
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading"><b>Cart</b></div>

          <table class="table">
          	<thead>
          		<tr>
          			<th style="text-align: center;">#</th>
          			<th>Nama Produk / Paket</th>
          			<th>Qty</th>
                <th>Harga</th>
                <th>Pengiriman</th>
          			<th>Biaya Pengiriman</th>
          			<th style="text-align: right;">Jumlah</th>
          			<th></th>
          		</tr>
          	</thead>
          	<tbody>
          		<?php $n= 1;
                    $total  = 0;
              ?>
          		@foreach($carts as $cart)
              <tr>
                <?php
                  
                if (!empty($cart->id_produk)) {
                  $produk = App\Models\Produk::where('id', $cart->id_produk)->select('nama_produk as produk', 'harga')->first();
                  $tagihan = App\Models\ProdukPengiriman::where('id', $cart->id_pengiriman)->select('tagihan', 'id_lokasi')->first();
                } else {
                  $produk = App\Models\Paket::where('id', $cart->id_paket)->select('nama_paket as produk', 'harga')->first();
                  $tagihan = App\Models\PaketPengiriman::where('id', $cart->id_pengiriman)->select('tagihan', 'id_lokasi')->first();
                }
                  $lokasi = App\Models\Lokasi::where('id', $tagihan->id_lokasi)->select('wilayah','lokasi')->first();
                  
                $total += $produk->harga*$cart->qty+$tagihan->tagihan;
                  
                ?>
                <td style="text-align: center;">{{$n++}}</td>
                <td>{{(!empty($produk))? $produk->produk: 'Produk/Paket Terjadi Perubahan'}}</td>
                <td>{{$cart->qty}}</td>
                <td>{{number_format($produk->harga,0,",",".")}}</td>
                <td>{{(!empty($lokasi))? $lokasi->wilayah.' - '.$lokasi->lokasi : 'Produk/Paket Terjadi Perubahan'}}</td>
                <td>{{(!empty($tagihan))? number_format($tagihan->tagihan,0,",","."): 'Produk/Paket Terjadi Perubahan'}}</td>
                
                <td style="text-align: right;">{{number_format($produk->harga*$cart->qty+$tagihan->tagihan,0,",",".")}}</td>
                  <td><a href="{{url('member/cart/remove/'.$cart->id)}}" class="btn btn-warning btn-sm">Hapus</a></td>
              </tr>
              
              @endforeach


            @if(count($carts)!=0)
  			    <tr>
  			    	<td colspan="5"></td>
  			    	<td>Jumlah Tagihan</td>
  			    	<td style="text-align: right;"><b>{{number_format(str_replace(",","",$total),0,",",".")}}</b></td>
  	                <td><a href="{{url('member/cart/removeall')}}" class="btn btn-danger btn-sm">Reset</a></td>
  			    </tr>
            @else
            <tr>
              <td colspan="7" style="text-align: center"> Cart Anda Masih Kosong</td>
            </tr>
            @endif
          	</tbody>
          </table>
          <br>
          @if(count($carts)!=0)
          <div class="panel-body" style="background-color: #0001">
          	<div class="row">
          		<div class="col-sm-8">
          			Sialahkan Melakukan Konfirmasi Pembayaran dengan Menekan Tombol "Lunasi", Saldo Anda akan automatis terpotong. Jika belum melakukan TOPUP silahakn melakukan topup terlebih dahulu
          		</div>
          		<div class="col-sm-4" style="text-align: right;">

          			<a href="{{url('member/cart/lunasi')}}" class="btn btn-lg btn-primary">Lunasi</a>
          		</div>
          	</div>
          </div>
          @endif
      </div>
    </div>
  </div>

@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection