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
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>

          <div class="panel-body">
              You are logged in!
          </div>

      </div>
    </div>
  </div>

    <div class="row">
      @foreach($produks as $produk)
      <?php
        $pgambar = App\Models\ProdukGambar::where('id_produk', $produk->id)->first();
        $plokasi = App\Models\ProdukPengiriman::where('id_produk', $produk->id)->first();
        $pstok = App\Models\StokProduk::where('id_produk', $produk->id)->orderBy('id','DESC')->first();
      ?>
      @if(!empty($pgambar) && !empty($pstok) && !empty($plokasi))
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail" style="background-color:white">
          <img src="{{asset('images/produk/'.$pgambar->gambar)}}">
          <div class="caption">
            <h3>{{$produk->nama_produk}}</h3>
            <p>{{$produk->deskripsi}}</p>
            <p>Harga <b>{{$produk->harga}}</b></p>
            <p>
              <a href="{{url('member/cart/store/produk/'.$produk->id)}}" class="btn btn-primary" role="button">Beli</a>
              <a href="#" class="btn btn-default" role="button">Detail</a></p>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
           
@endsection
