@extends('member.member-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">
            <b>Deskripsi Detail Paket</b>
          </div>
          <div class="panel-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}
                  </div>
              @endif
              
              <div class="row">
                <div class="col-sm-12">
                 <table class="table">
                   <tr>
                     <th>Nama Paket</th>
                     <td><b>{{$paket->nama_paket}}</b></td>
                   </tr>
                   <tr>
                     <th>Deskripsi Paket</th>
                     <td>{{$paket->deskripsi}}</td>
                   </tr>
                   <tr>
                    <?php
                        $lokasi= App\Models\Lokasi::find($paket->lokasi);
                    ?>
                     <th>Lokasi Produk</th>
                     <td>{{(!empty($lokasi))? $lokasi->wilayah.' - '.$lokasi->lokasi : 'Tidak Diketahui'}}</td>
                   </tr>
                 </table>

                  <table class="table">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                    </tr>
                     @foreach($isipakets as $isipaket)
                      <tr>
                        <td>{{$isipaket->nama_produk}}</td>
                        <td>{{$isipaket->harga}}</td>
                        <td>{{$isipaket->deskripsi}}</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td colspan="2">
                          <?php
                            $produkgambars = App\Models\ProdukGambar::where('id_produk', $isipaket->id_produk)->get();
                          ?>
                            @foreach($produkgambars as $produkgambar)
                              <img src="{{asset('images/produk/'.$produkgambar->gambar)}}" class="img-thumbnails" alt="..." width="100px">
                            @endforeach
                        </td>
                      </tr>
                    </tr>
                    @endforeach
                  </table>
                  <hr>

                 Tarif Transport
                  <table class="table">
                    <tr>
                        <th>Wilayah</th>
                        <th>Lokasi</th>
                        <th>Tagihan</th>
                    </tr>
                    @foreach($ppengirimans as $ppengiriman)
                    <tr>
                        <td>{{$ppengiriman->wilayah}}</td>
                        <td>{{$ppengiriman->lokasi}}</td>
                        <td>{{$ppengiriman->tagihan}}</td>
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
