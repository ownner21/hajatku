@extends('member.member-template')
@section('menu')
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Transaksi Saya
  </a>
</div>
@endsection
@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Transaksi 

          <span style="float: right">

          </span>
          </div>
          <div class="panel-body">
              
              <div class="row">
                <div class="col-sm-12">
                  Berikut Transaksi yang pernah anda lakukan, cek status setiap transaksi anda dengan menekan tombol "Tracking"
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
              @foreach($transaksis as $transaksi)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{ sprintf("%05d", $transaksi->id)}}</td>
                <td>{{(!empty($transaksi->nama_paket))? 'Paket '. $transaksi->nama_paket : 'Produk '. $transaksi->nama_produk }}</td>
                <td>{{$transaksi->harga}}</td>
                <td>{{$transaksi->qty}}</td>
                <td>{{$transaksi->total_bayar}}</td>
                <td>{{$transaksi->waktu_pesan}}</td>
                <td>{{$transaksi->status}}</td>
                <td>
                  <a href="{{url('member/transaksi/tracking/'.$transaksi->id)}}" class="btn btn-default btn-sm">Tracking</a>
                  
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
