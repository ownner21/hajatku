@extends('member.member-template')

@section('content')
  <div class="row">
  	@if (session('success'))
  	<div class="col-sm-12">
	  <div class="alert alert-success">
	      {!! session('success') !!}
	  </div>
	 </div>
	@endif

    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Stok Produk <b>{{$produk->nama_produk}}</b>

          <span style="float: right">

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah</button>

          </span>
          </div>
          <div class="panel-body">
              
              
              <div class="row">
                <div class="col-sm-12 col-md-4">
                   Berikut Riwayat Keluar Masuk Barang 
                   <h3>Stok Tersisa {{$stokskarang->stok_akhir}}</h3>
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Waktu</th>
                <th>Debit/Kredit</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($stoks as $stok)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$stok->created_at}}</td>
                <td>{{(empty($stok->debit))? $stok->kredit: $stok->debit}}</td>
                <td>{{$stok->keterangan}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title"> Tambah Lokasi</h4>
      </div>
      <form action="{{route('stok.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="id_produk" value="{{$id_produk}}">
          <div class="row form-group">
            <label for="debit" class="col-sm-3 control-label">Debit</label>
            <div class="col-sm-8">
            <input type="number" class="form-control" id="debit" name="debit" placeholder="Debit" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
            
@endsection
@section('script')
@endsection