@extends('member.member-template')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection

@section('menu')
<div class="list-group">
  <a href="{{url('member')}}" class="list-group-item list-group-item-action active">
    Semua Kategori
  </a>
  @foreach($kategoris as $kategori)
  <a href="{{url('member/kategori/'.$kategori->slug_kategori)}}" class="list-group-item list-group-item-action">{{$kategori->kategori}}</a>
  @endforeach
</div>
@endsection

@section('content')
  <div class="row">
    @if (session('success'))
      <div class="col-sm-12">
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
      </div>
    @endif
    @if (session('gagal'))
      <div class="col-sm-12">
        <div class="alert alert-danger">
            {!! session('gagal') !!}
        </div>
      </div>
    @endif
    <div class="col-sm-12">
            <img class="img-rounded" src="{{asset('images/tampilan/tampilansementara.PNG')}}" style="width: 100%;">
    </div>
  </div>
  <br>
    <div class="row">
      @foreach($produks as $produk)
      <?php
        $pgambar = App\Models\ProdukGambar::where('id_produk', $produk->id)->first();
        $plokasi = App\Models\ProdukPengiriman::where('id_produk', $produk->id)->first();
        $pstok = App\Models\StokProduk::where('id_produk', $produk->id)->orderBy('id','DESC')->first();
      ?>
      @if(!empty($pgambar) && !empty($pstok) && !empty($plokasi) && $pstok->stok_akhir!=0 && $pstok->stok_akhir >= $produk->min_pemesanan)
      <div class="col-sm-6 col-md-3">
        <div class="thumbnail" style="background-color:white">
          <img src="{{asset('images/produk/'.$pgambar->gambar)}}">
          <div class="caption">
            <h3>{{$produk->nama_produk}}</h3>
            <p>{{$produk->deskripsi}}</p>
            <p>Harga <b>{{$produk->harga}}</b></p>
            <p>Stok  <b>{{$pstok->stok_akhir}} (min : {{$produk->min_pemesanan}} max : {{$produk->max_pemesanan}})</b></p>
            <p>
              @if($produk->id_member != Auth::user('member')->id)
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupdate"
                     data-id="{{$produk->id}}" 
                     data-beli="produk"
                     data-namaproduk="{{$produk->nama_produk}}" 
                     data-deskripsi="{{$produk->deskripsi}}" 
                     data-minbeli="{{$produk->min_pemesanan}}" 
                     data-maxbeli="{{$produk->max_pemesanan}}"
                     data-harga= "{{$produk->harga}}"
                       >Beli</button>
              @endif
              {{-- <a href="{{url('member/cart/store/produk/'.$produk->id)}}" class="btn btn-primary" role="button">Beli</a> --}}
              <a href="{{url($produk->slug_produk.'-i.'.$produk->id)}}" class="btn btn-default" role="button">Detail</a></p>
          </div>
        </div>
      </div>
      @endif
      @endforeach

      @if(empty($produks))
      Produk Tidak Ada yang Tersedia
      @endif
    </div>

    <hr>
    <div class="row">
        @foreach($pakets as $paket)
        <?php
          $isipakets = App\Models\IsiPaket::where('id_paket', $paket->id)->get();
          if (!empty($isipakets)) {
            $produk = App\Models\Produk::where('id', $isipakets[0]->id_produk)->first();
            $pgambar = App\Models\ProdukGambar::where('id_produk', $produk->id)->first();
          }
          $plokasi = App\Models\PaketPengiriman::where('id_paket', $paket->id)->first();
        ?>
        @if(!empty($pgambar) &&  !empty($plokasi))
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail" style="background-color:white">
            <img src="{{asset('images/produk/'.$pgambar->gambar)}}">
            <div class="caption">
              <h3>{{$paket->nama_paket}}</h3>
              <p>{{$paket->deskripsi}}</p>
              <p>Harga <b>{{$paket->harga}}</b></p>
              <p>Lokasi <b>{{$paket->lokasi}}</b></p>
              <p>
                @if($paket->id_member != Auth::user('member')->id)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupdate"
                       data-id="{{$paket->id}}" 
                       data-beli="paket"
                       data-namaproduk="{{$paket->nama_paket}}" 
                       data-deskripsi="{{$paket->deskripsi}}"
                       data-harga= "{{$paket->harga}}"
                       >Beli</button>
                @endif
                {{-- <a href="{{url('member/cart/store/produk/'.$produk->id)}}" class="btn btn-primary" role="button">Beli</a> --}}
                <a href="{{url('member/paket/id/'.$paket->id)}}" class="btn btn-default" role="button">Detail</a></p>
            </div>
          </div>
        </div>
        @endif
        @endforeach
  
        @if(empty($produks))
        Paket Tidak Ada yang Tersedia
        @endif
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
          <input type="hidden" name="id_paket" id="id_paket">
          <input type="hidden" name="type" id="type">

          <div class="row form-group">
            <label for="label-nama-isi" class="col-sm-4 control-label" id="label-nama"></label>
            <div class="col-sm-8" id="label-nama-isi">
            </div>
          </div>
          <div class="row form-group">
            <label for="label-nama-deskripsi" class="col-sm-4 control-label"> Deskripsi</label>
            <div class="col-sm-8" id="label-nama-deskripsi">
            </div>
          </div>
          <div class="row form-group" id="ppaket">
              <label for="produkpaket" class="col-sm-4 control-label"> Produk</label>
              <div class="col-sm-8" id="produkpaket">
                  <ul class="list-group" id="isiprodukpaket"></ul>
              </div>
          </div>
          <div class="row form-group" id="jumlah">
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
            <label for="lokasi" class="col-sm-4 control-label">Tagihan Pengiriman</label>
            <div class="col-sm-8" id="tagihan">
            </div>
          </div>
          <div class="row form-group">
              <label for="tagihanp" class="col-sm-4 control-label" id="label-tagihanp"></label>
              <div class="col-sm-8" id="tagihanp">
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
  var beli = button.data('beli');
  var harga = button.data('harga');
  var minbeli = button.data('minbeli');
  var maxbeli = button.data('maxbeli');

  //menampilkan pengiriman tersedia
  $.get('{{ url('member/cart/pengiriman/')}}/'+beli+'/'+id, function(data){
      $('#tagihan').empty();
      $('#pilihlokasi').empty();
      $('#pilihlokasi').append("<option disabled selected>Pilih Pengiriman</option>");
      $.each(data, function(index, element){
          $('#pilihlokasi').append("<option value=" +element.id_pengiriman+ ">" + element.wilayah +" "+ element.lokasi + "</option>");
      });
  });

  var modal = $(this)

  //aksi data modal default
  modal.find('.modal-title').text('Pilih Lokasi Pengiriman');
  
  modal.find('#type').val(beli);
  modal.find('#label-nama-isi').text(namaproduk);
  modal.find('#label-nama-deskripsi').text(deskripsi);
  modal.find('#tagihanp').text(harga);
  document.getElementById("beli").innerHTML="Beli";

  //id untuk mnampilkan produk dalam paket
  document.getElementById('ppaket').style.display = 'none';

  if (beli=='paket') {
    document.getElementById('jumlah').style.display = 'none';
    document.getElementById('ppaket').style.display = 'block';

    modal.find('#id_paket').val(id);
    modal.find('#label-nama').text('Nama Paket');
    modal.find('#label-tagihanp').text('Tagihan paket');

    $.get('{{ url('member/cart/produkpaket/')}}/'+id, function(data){
      $('#isiprodukpaket').empty();
      $.each(data, function(index, element){
          $('#isiprodukpaket').append('<li class="list-group-item"><span class="badge">'+element.harga+'</span>'+element.nama_produk+'</li>');
      });
    });
  } else {
    document.getElementById('jumlah').style.display = 'block';
    modal.find('#id_produk').val(id);
    modal.find('#minbeli').val(minbeli);
    modal.find('#minbeli').attr("min",minbeli);
    modal.find('#minbeli').attr("max",maxbeli);
    modal.find('#label-nama').text('Nama Produk');
    modal.find('#label-tagihanp').text('Tagihan Produk');
  }
  
})

$('#pilihlokasi').on('change', function(e){
    var id = e.target.value;
    var type = document.getElementById("type").value;
    $('#tagihan').empty();
    $.get('{{ url('/member/cart/tagihanpengiriman/')}}/'+type+'/'+id, function(data){
        $('#tagihan').text(data['tagihan']);
        var tagihanp = $("#tagihanp").text();
        var penjumlahan = parseInt(data['tagihan'])+parseInt(tagihanp);
       document.getElementById("beli").removeAttribute("disabled");
       document.getElementById("beli").innerHTML="Beli ("+penjumlahan+")";
    });
});
</script>
@endsection
