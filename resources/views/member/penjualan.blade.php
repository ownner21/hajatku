@extends('member.member-template')
@section('menu')
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Penjualan Saya
  </a>
</div>
@endsection
@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Penjualan Anda 

          <span style="float: right">

          </span>
          </div>
          <div class="panel-body">
              
              <div class="row">
                <div class="col-sm-12">
                  Berikut transaksi penjualan anda, lakukan update setiap proses yang anda kerjakan agar tidak ada timbul kekhawatiran. Klik pada tombol "Detail" untuk merubah setiap proses
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <td>Transaksi</td>
                <th>Nama Paket/ Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total Bayar</th>
                <th>Waktu Pesan</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($penjualans as $penjualan)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{ sprintf("%05d", $penjualan->id)}}</td>
                <td>{{(!empty($penjualan->nama_paket))? 'Paket '. $penjualan->nama_paket : 'Produk '. $penjualan->nama_produk }}</td>
                <td>{{$penjualan->harga}}</td>
                <td>{{$penjualan->qty}}</td>
                <td>{{$penjualan->total_bayar}}</td>
                <td>{{$penjualan->waktu_pesan}}</td>
                <td>{{$penjualan->status}}</td>
                <td>
                  <a href="{{url('member/penjualan/tracking/'.$penjualan->id)}}" class="btn btn-default btn-sm">Detail</a>
                  
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>

@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
