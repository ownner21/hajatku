@extends('member.member-template')
@section('menu')
@foreach($produkgambars as $produkgambar)
  <img src="{{asset('images/produk/'.$produkgambar->gambar)}}" class="img-thumbnails" alt="..." width="100%">
@endforeach
@endsection
@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}
                  </div>
              @endif
              
              <div class="row">
                <div class="col-sm-12">
                  <h2 style="margin-top: 0px">{{$produk->nama_produk}} </h2>
                </div>
                <div class="col-sm-12">
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

                  <hr>
                  @if($produk->id_member != Auth::user('member')->id)
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupdate" style="min-width: 200px" 
                     data-id="{{$produk->id}}" 
                     data-namaproduk="{{$produk->nama_produk}}" 
                     data-deskripsi="{{$produk->deskripsi}}" 
                     data-minbeli="{{$produk->min_pemesanan}}" 
                     data-maxbeli="{{$produk->max_pemesanan}}"
                     >Beli</button>
                  @endif

                </div>
              </div>
             
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
      <form action="{{route('cart.store')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="id_produk" id="id_produk">

          <div class="row form-group">
            <label for="wilayah" class="col-sm-4 control-label" id="label-nama"></label>
            <div class="col-sm-8" id="label-nama-isi">
            </div>
          </div>
          <div class="row form-group">
            <label for="wilayah" class="col-sm-4 control-label"> Deskripsi</label>
            <div class="col-sm-8" id="label-nama-deskripsi">
            </div>
          </div>
          <div class="row form-group">
            <label for="wilayah" class="col-sm-4 control-label"> Jumlah / Qty</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" name="qty" placeholder="qty" id="minbeli">
            </div>
          </div>
          <div class="row form-group">
            <label for="wilayah" class="col-sm-4 control-label">Pengiriman</label>
            <div class="col-sm-8">
            <select class="form-control" id="pilihlokasi" name="id_pengiriman" required></select>
            </div>
          </div>
          <div class="row form-group">
            <label for="lokasi" class="col-sm-4 control-label">Tagihan</label>
            <div class="col-sm-8" id="tagihan">
            </div>
          </div>
          <div class="row form-group">
            <label for="lokasi" class="col-sm-4 control-label">Alamat Detail</label>
            <div class="col-sm-8" id="tagihan">
              <textarea class="form-control" name="alamat" placeholder="Alamat Detail Pembeli" required></textarea>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="beli" disabled class="btn btn-primary">Beli</button>
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
  var id = button.data('id');
  var namaproduk = button.data('namaproduk');
  var deskripsi = button.data('deskripsi');
  var minbeli = button.data('minbeli');
  var maxbeli = button.data('maxbeli');
  console.log(id);
  $.get('{{ url('member/cart/pengiriman/produk')}}/'+id, function(data){
      $('#tagihan').empty();
      $('#pilihlokasi').empty();
      $('#pilihlokasi').append("<option disabled selected>Pilih Pengiriman</option>");
      $.each(data, function(index, element){
          $('#pilihlokasi').append("<option value=" +element.id_pengiriman+ ">" + element.wilayah +" "+ element.lokasi + "</option>");
      });
  });
  var modal = $(this)

  modal.find('.modal-title').text('Pilih Lokasi Pengiriman')
  modal.find('#label-nama').text('Nama Produk')
  modal.find('#label-nama-isi').text(namaproduk)
  modal.find('#label-nama-deskripsi').text(deskripsi)
  modal.find('#minbeli').val(minbeli)
  modal.find('#minbeli').attr("min",minbeli);
  modal.find('#minbeli').attr("max",maxbeli);
  modal.find('#id_produk').val(id)
})
$('#pilihlokasi').on('change', function(e){
    var id = e.target.value;
    $('#tagihan').empty();
    $.get('{{ url('/member/cart/tagihanpengiriman/')}}/'+id, function(data){
        $('#tagihan').text(data);
       document.getElementById("beli").removeAttribute("disabled");
    });
});
</script>
@endsection