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
            <li class="{{(!empty($transaksi->waktu_pesan))? 'active': ''}}">Pemesanan</li>
            <li class="{{(!empty($transaksi->waktu_konfirmasi))? 'active': ''}}">Konfirmasi</li>
            <li class="{{(!empty($transaksi->waktu_pengerjaan))? 'active': ''}}">Proses Pengerjaan</li>
            <li class="{{(!empty($transaksi->waktu_pengiriman))? 'active': ''}}">Pengiriman</li>
            <li class="{{(!empty($transaksi->waktu_selesai))? 'active': ''}}">Selesai</li>
        </ul>
    </div>
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Nomor Transaksi #{{ sprintf("%05d", $transaksi->id)}}

          <span style="float: right">

          </span>
          </div>
          @if(!empty($transaksi->waktu_pengiriman) && empty($transaksi->waktu_selesai))
          <div class="panel-body">
              
              <div class="row">
                <div class="col-sm-8">
                    Silahkan Mengkonfirmasi Pembelian Anda
                </div>
                <div class="col-sm-4" style="text-align: right;">
                   <a href="{{url('member/transaksi/selesai/'.$transaksi->id)}}" class="btn btn-danger btn-lg">Pesanan Diterima</a>
                </div>
              </div>
          </div>
          @endif
          <table class="table">
            <tr>
              <th>Nomor Transaksi</th>
              <td>{{ sprintf("%05d", $transaksi->id)}}
              </td>
            </tr>
            <tr>
              <th>Produk</th>
              <td>
                <?php 
                  $produk = json_decode($transaksi->produk);
                  $cek = App\Models\Produk::find($produk->id);
                  $lokasi = App\Models\Lokasi::find($transaksi->id_lokasi);
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
              <td>{{(!empty($transaksi->nama_paket))? 'Paket '. $transaksi->nama_paket : 'Produk '. $transaksi->nama_produk }}</td>
            </tr>
            <tr>
              <th>Qty</th>
              <td>{{$transaksi->qty}}</td>
            </tr>
            <tr>
              <th>Harga</th>
              <td>{{$transaksi->harga}}</td>
            </tr>
            <tr>
              <th>Biaya Pengiriman</th>
              <td>{{$transaksi->biaya_kirim . ' ('. $lokasi->wilayah.'-'.$lokasi->lokasi.')'}}</td>
            </tr>
            
            <tr>
              <th>Total bayar</th>
              <td>{{$transaksi->total_bayar}}</td>
            </tr>
            <tr>
              <th>Alamat Pengiriman</th>
              <td>{{$transaksi->alamat}}</td>
            </tr>
            <tr> <th>Waktu Pesan</th> <td>{{$transaksi->waktu_pesan}}</td></tr>
            @if(!empty($transaksi->waktu_konfirmasi))<tr> <th>Waktu Konfirmasi Penjual</th> <td>{{$transaksi->waktu_konfirmasi}}</td></tr>@endif
            @if(!empty($transaksi->waktu_pengerjaan))<tr> <th>Waktu Pengerjaan</th> <td>{{$transaksi->waktu_pengerjaan}}</td></tr>@endif
            @if(!empty($transaksi->waktu_pengiriman))<tr> <th>Waktu Pengiriman</th> <td>{{$transaksi->waktu_pengiriman}}</td></tr>@endif
            @if(!empty($transaksi->waktu_kembali))<tr> <th>Waktu Dibatalkan</th> <td>{{$transaksi->waktu_kembali}}</td></tr>@endif
            @if(!empty($transaksi->waktu_selesai))<tr> <th>Waktu Selesai</th> <td>{{$transaksi->waktu_selesai}}</td></tr>@endif
            <tr>
              <th>Status</th>
              <td>{{$transaksi->status}}</td>
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
