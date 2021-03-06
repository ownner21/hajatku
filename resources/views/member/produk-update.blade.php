@extends('member.member-template')
@section('css')
  <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
  <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection
@section('menu')
<div class="list-group">
  <a href="{{url('member/produk')}}" class="list-group-item list-group-item-action active">
    Produk Saya
  </a>
  <a href="{{url('member/produk/id/'.$produk->id)}}" class="list-group-item list-group-item-action">
    Lihat Produk ini
  </a>
  <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target=".bs-tambah-modal-sm">Tambah Produk</a>
</div>
@endsection
@section('content')
  <div class="row">
    @if (session('success'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    </div>
    @endif
    <div class="col-sm-12">

       <div class="panel panel-default">
          <div class="panel-heading">Detail Produk / Update</div>
          <div class="panel-body">

              <form class="form-horizontal" action="{{route('produk.update')}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <input type="hidden" name="id" value="{{$produk->id}}">
                  <div class="form-group row">
                    <label for="nama_produk" class="col-md-3 control-label">Nama Produk</label>
                    <div class="col-md-8">
                    <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" value="{{$produk->nama_produk}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="deskripsi" class="col-md-3 control-label">Deskripsi Produk</label>
                    <div class="col-md-8">
                    <textarea type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Produk">{{$produk->deskripsi}}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="lokasi" class="col-md-3 control-label">Lokasi Produk</label>
                    <div class="col-md-8">
                    <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Produk" value="{{$produk->lokasi}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="min_pemesanan" class="col-md-3 control-label">Pemesanan</label>
                    <div class="col-md-4">
                    <input type="number" class="form-control" name="min_pemesanan" placeholder="Min Pemesanan" min="1" value="{{$produk->min_pemesanan}}">
                    </div>
                    <div class="col-md-4">
                    <input type="number" class="form-control" name="max_pemesanan" placeholder="Max Pemesanan" min="1" value="{{$produk->max_pemesanan}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="harga" class="col-md-3 control-label">Harga Produk</label>
                    <div class="col-md-8">
                    <input type="number" class="form-control" name="harga" placeholder="Harga Satuan" value="{{$produk->harga}}" min="0">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kode_produk" class="col-md-3 control-label">Kode Produk</label>
                    <div class="col-md-8">
                    <input type="text" class="form-control" name="kode_produk" placeholder="Kode Produk (Opsional)" value="{{$produk->kode_produk}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="id_kategori" class="col-md-3 control-label">Kategori</label>
                    <div class="col-md-8">
                     <select class="form-control" id="id_kategori" name="id_kategori" required>
                      <option disabled> Pilih Kategori</option>
                      @foreach($kategoris as $kategori)
                      <option value="{{$kategori->id}}" {{($produk->id_kategori== $kategori->id)? 'selected': ''}}>{{$kategori->kategori}}</option>
                      @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-3 col-md-offset-3">
                      <button type="submit" class="btn btn-primary" >Update Produk</button>
                      </div>
                  </div>

              </form>
             
          </div>
      </div>
    </div>

      <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Layanan Pengiriman <span style="float: right;">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah</button>
          </span></div>
            <table class="table">
              <tr>
                <th style="text-align: center">#</th>
                <th>Wilayah</th>
                <th>Lokasi</th>
                <th>Tagihan</th>
                <th>Action</th>
              </tr>
              <?php $n= 1;?>
              @foreach($produkpengirimans as $produkpengiriman)
              <?php
                $lokasi = App\Models\Lokasi::find($produkpengiriman->id_lokasi);
              ?>
              <tr>
                <th style="text-align: center">{{$n++}}</th>
                <td>{{(!empty($lokasi))? $lokasi->wilayah: 'Tidak Diketahui'}}</td>
                <td>{{(!empty($lokasi))? $lokasi->lokasi: 'Tidak Diketahui'}}</td>
                <td>{{$produkpengiriman->tagihan}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalupdate"
                     data-id="{{$produkpengiriman->id}}" 
                     data-lokasi="{{$produkpengiriman->id_lokasi}}"  
                     data-tagihan="{{$produkpengiriman->tagihan}}" 
                     >Update</button>

                     <a href="{{url('member/produk/pengiriman/delete/'.$produkpengiriman->id)}}" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Anda yakin hapus ?')">Hpaus</a>
                </td>
              </tr>
              @endforeach
            </table>

        </div>
      </div>

       <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Produk Gambar <span style="float: right;">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-gambar-sm">Tambah</button>
          </span></div>
          <div class="panel-body">
            <div class="row">
            @foreach($produkgambars as $produkgambar)
                <div class="col-sm-6 col-md-3">
                  <div class="thumbnail">
                    <img src="{{asset('images/produk/'.$produkgambar->gambar)}}" alt="...">
                    <div class="caption">
                      <p><a href="{{url('member/produk/gambar/delete/'.$produkgambar->id)}}" class="btn btn-danger btn-sm" role="button">Hapus</a> <a href="{{asset('images/produk/'.$produkgambar->gambar)}}" class="btn btn-default btn-sm" role="button" target="_blank">Lihat</a></p>
                    </div>
                  </div>
                </div>
            @endforeach
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
        <h4 class="modal-title" id="modal-title"> Tambah Lokasi</h4>
      </div>
      <form class="form-horizontal" action="{{route('produk.pengiriman.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="id_produk" value="{{$produk->id}}">

          <div class="row form-group">
            <label for="id_lokasi" class="col-md-3 control-label">Lokasi</label>
            <div class="col-md-8">
            <select class="form-control" id="id_lokasi" name="id_lokasi" required>
              <option value="" disabled selected> Pilih Lokasi</option>
              @foreach($lokasis as $lokasi)
              <option value="{{$lokasi->id}}"><b>{{$lokasi->wilayah}}</b> - {{$lokasi->lokasi}}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="row form-group">
            <label for="tagihan" class="col-md-3 control-label">tagihan</label>
            <div class="col-md-8">
            <input type="number" class="form-control" id="tagihan" name="tagihan" min="0" placeholder="Tagihan">
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

<div class="modal fade bs-example-gambar-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title"> Gambar Tambah</h4>
      </div>
      <div class="modal-body">
      <form class="dropzone form-horizontal" action="{{route('produk.gambar.tambah')}}" enctype="multipart/form-data" method="post">
        <input type="hidden" value="{{$produk->id}}" name="id_produk">
        {{ csrf_field() }}

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="modalupdate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <form class="form-horizontal" action="{{route('produk.pengiriman.update')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <input type="hidden" name="id" id="id">

          <div class="row form-group">
            <label for="id_lokasi" class="col-md-3 control-label">Lokasi</label>
            <div class="col-md-8">
            <select class="form-control" id="id_lokasi" name="id_lokasi" required>
              <option disabled> Pilih Kategori</option>
              @foreach($lokasis as $lokasi)
              <option value="{{$lokasi->id}}"><b>{{$lokasi->wilayah}}</b> - {{$lokasi->lokasi}}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="row form-group">
            <label for="tagihan" class="col-md-3 control-label">tagihan</label>
            <div class="col-md-8">
            <input type="number" class="form-control" id="tagihan" name="tagihan" min="0" placeholder="Tagihan">
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade bs-tambah-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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

$('#modalupdate').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id')
  var tagihan = button.data('tagihan')
  var lokasi = button.data('lokasi')
  var modal = $(this)

  modal.find('.modal-title').text('Update Pengiriman')
  modal.find('#id').val(id)
  modal.find('#tagihan').val(tagihan)
  modal.find('#id_lokasi').val(lokasi)
})
</script>
@endsection