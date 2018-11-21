@extends('member.member-template')

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
          <div class="panel-heading">Detail Paket / Update</div>
          <div class="panel-body">

              <form class="form-horizontal" action="{{route('paket.update')}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <input type="hidden" name="id" value="{{$paket->id}}">
                  <div class="form-group row">
                    <label for="nama_paket" class="col-md-3 control-label">Nama Paket</label>
                    <div class="col-md-8">
                    <input type="text" class="form-control" name="nama_paket" placeholder="Nama Paket" value="{{$paket->nama_paket}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="deskripsi" class="col-md-3 control-label">Deskripsi Produk</label>
                    <div class="col-md-8">
                    <textarea type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Produk">{{$paket->deskripsi}}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="lokasi" class="col-md-3 control-label">Lokasi/Wilayah</label>
                    <div class="col-md-8">
                     <select class="form-control" id="lokasi" name="lokasi" required>
                      <option disabled> Pilih Lokasi Operasional</option>
                      @foreach($lokasis as $lokasi)
                      <option value="{{$lokasi->id}}" {{($lokasi->id== $paket->lokasi)? 'selected': ''}}>{{$lokasi->wilayah. ' - '. $lokasi->lokasi}}</option>
                      @endforeach
                    </select>
                    </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3 col-md-offset-3">
                      <button type="submit" class="btn btn-primary" >Update Paket</button>
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
                <th>Produk</th>
                <th>@Harga</th>
                <th>Sisa</th>
                <th>Action</th>
              </tr>
              <?php $n= 1;?>
              @foreach($isipakets as $isipaket)
              <?php 
                  $stok = App\Models\StokProduk::where('id_produk', $isipaket->id_produk)->orderBy('id', 'DESC')->select('stok_akhir')->first();
              ?>
              <tr>
                <th style="text-align: center">{{$n++}}</th>
                <td>{{$isipaket->nama_produk}}</td>
                <td>{{$isipaket->harga}}</td>
                <td>{{$stok->stok_akhir}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalupdate"
                     data-id="{{$isipaket->id}}" 
                     data-produk="{{$isipaket->id_produk}}"  
                     >Update</button>

                     <a href="{{url('member/paket/produk/delete/'.$isipaket->id)}}" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Anda yakin hapus ?')">Hpaus</a>
                </td>
              </tr>
              @endforeach
            </table>

        </div>
      </div>

       <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Layanan Pengiriman <span style="float: right;">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-pengiriman-sm">Tambah</button>
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
              @foreach($ppengirimans as $ppengiriman)
              <?php
                $lokasi = App\Models\Lokasi::find($ppengiriman->id_lokasi);
              ?>
              <tr>
                <th style="text-align: center">{{$n++}}</th>
                <td>{{(!empty($lokasi))? $lokasi->wilayah: 'Tidak Diketahui'}}</td>
                <td>{{(!empty($lokasi))? $lokasi->lokasi: 'Tidak Diketahui'}}</td>
                <td>{{$ppengiriman->tagihan}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pengirimanupdate"
                     data-id="{{$ppengiriman->id}}" 
                     data-lokasi="{{$ppengiriman->id_lokasi}}"  
                     data-tagihan="{{$ppengiriman->tagihan}}" 
                     >Update</button>

                     <a href="{{url('member/paket/pengiriman/delete/'.$ppengiriman->id)}}" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Anda yakin hapus ?')">Hpaus</a>
                </td>
              </tr>
              @endforeach
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
      <form class="form-horizontal" action="{{route('paket.produk.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="id_paket" value="{{$paket->id}}">

          <div class="row form-group">
            <label for="id_produk" class="col-md-3 control-label">Produk</label>
            <div class="col-md-8">
            <select class="form-control" id="id_produk" name="id_produk" required>
              <option selected disabled> Pilih Produk</option>
              @foreach($produks as $produk)
              <option value="{{$produk->id}}">{{$produk->nama_produk.' - '.$produk->harga}}</option>
              @endforeach
            </select>
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

<div class="modal fade bs-example-pengiriman-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title"> Tambah Lokasi</h4>
      </div>
      <form class="form-horizontal" action="{{route('paket.pengiriman.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="id_paket" value="{{$paket->id}}">

          <div class="row form-group">
            <label for="id_lokasi" class="col-md-3 control-label">Lokasi</label>
            <div class="col-md-8">
            <select class="form-control" id="id_lokasi" name="id_lokasi" required>
              <option selected disabled> Pilih Lokasi</option>
              @foreach($lokasis as $lokasi)
              <option value="{{$lokasi->id}}"><b>{{$lokasi->wilayah}}</b> - {{$lokasi->lokasi}}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="row form-group">
            <label for="tagihan" class="col-md-3 control-label">tagihan</label>
            <div class="col-md-8">
            <input type="text" class="form-control" id="tagihan" name="tagihan" placeholder="Tagihan">
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
            <label for="id_produk" class="col-md-3 control-label">Produk</label>
            <div class="col-md-8">
            <select class="form-control" id="id_produk" name="id_produk" required>
              <option selected disabled> Pilih Produk</option>
              @foreach($produks as $produk)
              <option value="{{$produk->id}}">{{$produk->nama_produk.' - '.$produk->harga}}</option>
              @endforeach
            </select>
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


<div class="modal fade" id="pengirimanupdate" tabindex="-1" role="dialog" aria-labelledby="pengirimanupdate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <form class="form-horizontal" action="{{route('paket.pengiriman.update')}}" method="post">
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
            <input type="text" class="form-control" id="tagihan" name="tagihan" placeholder="Tagihan">
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

            
@endsection
@section('script')
<script type="text/javascript">

$('#modalupdate').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id')
  var produk = button.data('produk')
  var modal = $(this)

  modal.find('.modal-title').text('Update Produk')
  modal.find('#id').val(id)
  modal.find('#id_produk').val(produk)
})


$('#pengirimanupdate').on('show.bs.modal', function (event) {
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