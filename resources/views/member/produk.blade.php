@extends('member.member-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Produk 

          <span style="float: right">

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah Produk</button>

          </span>
          </div>
          <div class="panel-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}
                  </div>
              @endif
              
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <b>Saldo Anda Sekarang  </b> <br>
                   Riwayat Top Anda
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($produks as $produk)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$produk->nama_produk}}</td>
                <td>{{$produk->deskripsi}}</td>
                <td>{{$produk->harga}}</td>
                <td>
                  <a href="{{url('member/produk/id/'.$produk->id)}}" class="btn btn-default btn-sm">Lihat</a>
                  <a href="{{url('member/produk/edit/'.$produk->id)}}" class="btn btn-primary btn-sm">update</a>
                  <a onclick="event.preventDefault(); document.getElementById('hapus-form{{$produk->id}}').submit();" class="btn-sm btn btn-danger"> Hapus </a>
                    <form id="hapus-form{{$produk->id}}" action="{{ route('produk.hapus', ['id'=> $produk->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                    </form>
                  <a href="{{url('member/produk/stok/'.$produk->id)}}" class="btn btn-info btn-sm">Stok</a>
                </td>
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
        <h4 class="modal-title" id="modal-title"> Tambah Produk</h4>
      </div>
      <form class="form-horizontal" action="{{route('produk.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group row">
            <label for="nama_produk" class="col-md-3 control-label">Nama Produk</label>
            <div class="col-md-8">
            <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" value="{{old('nama_produk')}}" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="deskripsi" class="col-md-3 control-label">Deskripsi Produk</label>
            <div class="col-md-8">
            <textarea type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Produk" required>{{old('deskripsi')}}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="lokasi" class="col-md-3 control-label">Lokasi Produk</label>
            <div class="col-md-8">
            <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Produk" value="{{old('lokasi')}}" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="min_pemesanan" class="col-md-3 control-label">Pemesanan</label>
            <div class="col-md-4">
            <input type="number" class="form-control" name="min_pemesanan" placeholder="Min Pemesanan" value="{{old('min_pemesanan')}}" required>
            </div>
            <div class="col-md-4">
            <input type="number" class="form-control" name="max_pemesanan" placeholder="Max Pemesanan" value="{{old('max_pemesanan')}}" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="harga" class="col-md-3 control-label">Harga Produk</label>
            <div class="col-md-8">
            <input type="number" class="form-control" name="harga" placeholder="Harga Satuan" value="{{old('harga')}}" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="kode_produk" class="col-md-3 control-label">Kode Produk</label>
            <div class="col-md-8">
            <input type="text" class="form-control" name="kode_produk" placeholder="Kode Produk (Opsional)" value="{{old('kode_produk')}}">
            </div>
          </div>

          <div class="form-group row">
            <label for="id_kategori" class="col-md-3 control-label">Kategori</label>
            <div class="col-md-8">
             <select class="form-control" id="id_kategori" name="id_kategori" required>
              <option selected disabled> Pilih Kategori</option>
              @foreach($kategoris as $kategori)
              <option value="{{$kategori->id}}">{{$kategori->kategori}}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="stokawal" class="col-md-3 control-label">Stok Awal</label>
            <div class="col-md-8">
            <input type="text" class="form-control" name="stokawal" placeholder="Stok Awal" value="{{old('stokawal')}}" required>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Tambah Produk</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
