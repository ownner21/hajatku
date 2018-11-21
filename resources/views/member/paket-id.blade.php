@extends('member.member-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">{{$paket->nama_produk}} 

          </div>
          <div class="panel-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}
                  </div>
              @endif
              
              <div class="row">
                <div class="col-md-3 col-sm-12">
                  
                </div>
                <div class="col-md-9 col-sm-12">
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

                 <hr>

                 Isi Paket
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
