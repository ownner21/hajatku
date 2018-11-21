@extends('member.member-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">{{$produk->nama_produk}} 

          </div>
          <div class="panel-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}
                  </div>
              @endif
              
              <div class="row">
                <div class="col-md-3 col-sm-12">
                  @foreach($produkgambars as $produkgambar)
                    <img src="{{asset('images/produk/'.$produkgambar->gambar)}}" class="img-thumbnails" alt="..." width="100%">
                  @endforeach
                </div>
                <div class="col-md-9 col-sm-12">
                 <table class="table">
                   <tr>
                     <th>Nama Produk</th>
                     <td><b>{{$produk->nama_produk}}</b></td>
                   </tr>
                   <tr>
                     <th>Deskripsi Produk</th>
                     <td>{{$produk->deskripsi}}</td>
                   </tr>
                   <tr>
                     <th>Lokasi Produk</th>
                     <td>{{$produk->lokasi}}</td>
                   </tr>
                   <tr>
                     <th>Min Pemesanan</th>
                     <td>{{$produk->min_pemesanan}}</td>
                   </tr>
                   <tr>
                     <th>Max Pemesanan</th>
                     <td>{{$produk->max_pemesanan}}</td>
                   </tr>
                   <tr>
                     <th>Harga Produk</th>
                     <td>{{$produk->harga}}</td>
                   </tr>
                   <tr>
                     <th>Kode Produk</th>
                     <td>{{$produk->kode_produk}}</td>
                   </tr>
                 </table>

                 <hr>

                 Tarif Transport
                  <table class="table">
                    <tr>
                        <th>Wilayah</th>
                        <th>Lokasi</th>
                        <th>Tagihan</th>
                    </tr>
                    @foreach($produkpengirimans as $produkpengiriman)
                    <tr>
                        <td>{{$produkpengiriman->wilayah}}</td>
                        <td>{{$produkpengiriman->lokasi}}</td>
                        <td>{{$produkpengiriman->tagihan}}</td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
             
          </div>

      </div>
    </div>
  </div>


@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
