@extends('member.member-template')

@section('menu')
<div class="list-group">
  <a href="{{url('member/produk')}}" class="list-group-item list-group-item-action active">
    Produk Saya
  </a>
  <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah Produk</a>
</div>
@endsection
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
            <input type="number" class="form-control" name="min_pemesanan" placeholder="Min Pemesanan" value="{{old('min_pemesanan')}}" min="1" required>
            </div>
            <div class="col-md-4">
            <input type="number" class="form-control" name="max_pemesanan" placeholder="Max Pemesanan" value="{{old('max_pemesanan')}}" min="1" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="harga" class="col-md-3 control-label">Harga Produk</label>
            <div class="col-md-8">
            <input type="number" class="form-control" name="harga" placeholder="Harga Satuan" value="{{old('harga')}}" min="0" required>
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
            <input type="number" min="1" class="form-control" name="stokawal" placeholder="Stok Awal" value="{{old('stokawal')}}" required>
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
