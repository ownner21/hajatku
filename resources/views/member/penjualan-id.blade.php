@extends('member.member-template')

@section('css')
<style type="text/css">

.progressbar {
  margin: 0;
  padding: 0;
  counter-reset: step;
}
.progressbar li {
  list-style-type: none;
  width: 19%;
  float: left;
  font-size: 12px;
  position: relative;
  text-align: center;
  text-transform: uppercase;
  color: #7d7d7d;
}
.progressbar li:before {
  width: 30px;
  height: 30px;
  content: counter(step);
  counter-increment: step;
  line-height: 30px;
  border: 2px solid #7d7d7d;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  background-color: white;
}
.progressbar li:after {
  width: 100%;
  height: 2px;
  content: '';
  position: absolute;
  background-color: #7d7d7d;
  top: 15px;
  left: -50%;
  z-index: -1;
}
.progressbar li:first-child:after {
  content: none;
}
.progressbar li.active {
  color: green;
}
.progressbar li.active:before {
  border-color: #55b776;
}
.progressbar li.active + li:after {
  background-color: #55b776;
}
</style>
@endsection

@section('content')
  <div class="row">
    <div class="col-sm-12" style="min-height: 100px; padding: 20px">
      <ul class="progressbar">
            <li class="{{(!empty($penjualan->waktu_pesan))? 'active': ''}}">Pemesanan</li>
            <li class="{{(!empty($penjualan->waktu_konfirmasi))? 'active': ''}}">Konfirmasi</li>
            <li class="{{(!empty($penjualan->waktu_pengerjaan))? 'active': ''}}">Proses Pengerjaan</li>
            <li class="{{(!empty($penjualan->waktu_pengiriman))? 'active': ''}}">Pengiriman</li>
            <li class="{{(!empty($penjualan->waktu_selesai))? 'active': ''}}">Selesai</li>
        </ul>
    </div>
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Nomor penjualan #{{ sprintf("%05d", $penjualan->id)}}

          <span style="float: right">

          </span>
          </div>
          <div class="panel-body">
              
              <div class="row">
                <div class="col-sm-8">
                  @if(empty($penjualan->waktu_konfirmasi) && empty($penjualan->waktu_kembali))
                    Lakukan Konfirmasi Siap Melayani Pelanggan dengan cara klik tombol "Konfirmasi", Jika tidak siap klik tombol "Tidak Siap". 
                  @elseif(!empty($penjualan->waktu_konfirmasi ) && empty($penjualan->waktu_pengerjaan))
                    Jika Pemesanan siap diproses silahkan klik pada tombol di samping kanan
                  @elseif(!empty($penjualan->waktu_pengerjaan) && empty($penjualan->waktu_pengiriman))
                    Update Pemesanan ke Pengiriman
                  @elseif(!empty($penjualan->waktu_pengiriman) && empty($penjualan->waktu_selesai))
                    Menunggu Konfirmasi Selesai dari Pembeli
                  @endif
                </div>
                <div class="col-sm-4" style="text-align: right;">
                  @if(empty($penjualan->waktu_konfirmasi) && empty($penjualan->waktu_kembali))
                   <a href="{{url('member/penjualan/konfirmasi/'.$penjualan->id)}}" class="btn btn-primary btn-lg">Konfirmasi</a>
                   <a href="{{url('member/penjualan/tidaksiap/'.$penjualan->id)}}" class="btn btn-danger btn-lg">Tidak Siap</a>
                  @elseif(!empty($penjualan->waktu_konfirmasi) && empty($penjualan->waktu_pengerjaan))
                   <a href="{{url('member/penjualan/pengerjaan/'.$penjualan->id)}}" class="btn btn-danger btn-lg">Siap Dikerjakan</a>
                  @elseif(!empty($penjualan->waktu_pengerjaan) && empty($penjualan->waktu_pengiriman))
                   <a href="{{url('member/penjualan/pengiriman/'.$penjualan->id)}}" class="btn btn-danger btn-lg">Siap Dikirim</a>
                  @endif
                </div>
              </div>
             
          </div>
          <table class="table">
            <tr>
              <th>Nomor penjualan</th>
              <td>{{ sprintf("%05d", $penjualan->id)}}
              </td>
            </tr>
            <tr>
              <th>Produk</th>
              <td>
                <?php 
                  $produk = json_decode($penjualan->produk);
                  $cek = App\Models\Produk::find($produk->id);
                ?>
                @if(!empty($cek))
                 <a href="{{url('member/produk/id/'.$produk->id)}}"><b>{{$produk->nama_produk}}</b> {{$produk->deskripsi}}</a>
                @else
                 <b>{{$produk->nama_produk}}</b> {{$produk->deskripsi}}
                @endif
              </td>
            </tr>
            <tr>
              <th>Pembelian</th>
              <td>{{(!empty($penjualan->nama_paket))? 'Paket '. $penjualan->nama_paket : 'Produk '. $penjualan->nama_produk }}</td>
            </tr>
            <tr>
              <th>Harga</th>
              <td>{{$penjualan->harga}}</td>
            </tr>
            <tr>
              <th>Jumlah</th>
              <td>{{$penjualan->qty}}</td>
            </tr>
            <tr>
              <th>Total bayar</th>
              <td>{{$penjualan->total_bayar}}</td>
            </tr>
            <tr> <th>Waktu Pesan</th> <td>{{$penjualan->waktu_pesan}}</td></tr>
            @if(!empty($penjualan->waktu_konfirmasi))<tr> <th>Waktu Konfirmasi Penjual</th> <td>{{$penjualan->waktu_konfirmasi}}</td></tr>@endif
            @if(!empty($penjualan->waktu_pengerjaan))<tr> <th>Waktu Pengerjaan</th> <td>{{$penjualan->waktu_pengerjaan}}</td></tr>@endif
            @if(!empty($penjualan->waktu_pengiriman))<tr> <th>Waktu Pengiriman</th> <td>{{$penjualan->waktu_pengiriman}}</td></tr>@endif
            @if(!empty($penjualan->waktu_kembali))<tr> <th>Waktu Dibatalkan</th> <td>{{$penjualan->waktu_kembali}}</td></tr>@endif
            @if(!empty($penjualan->waktu_selesai))<tr> <th>Waktu Selesai</th> <td>{{$penjualan->waktu_selesai}}</td></tr>@endif
            <tr>
              <th>Status</th>
              <td>{{$penjualan->status}}</td>
            </tr>
             
          </table>

      </div>
    </div>
  </div>

@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
