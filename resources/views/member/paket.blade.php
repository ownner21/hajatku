@extends('member.member-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Paket 

          <span style="float: right">

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah Paket</button>

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
                  Daftar Paket yang anda telah buat
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Nama Paket</th>
                <th>Lokasi</th>
                <th>Harga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($pakets as $paket)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$paket->nama_paket}}</td>
                <td>{{$paket->lokasi}}</td>
                <td>9000</td>
                <td>
                  <a href="{{url('member/paket/id/'.$paket->id)}}" class="btn btn-default btn-sm">Lihat</a>
                  <a href="{{url('member/paket/edit/'.$paket->id)}}" class="btn btn-primary btn-sm">update</a>
                  <a onclick="event.preventDefault(); document.getElementById('hapus-form{{$paket->id}}').submit();" class="btn-sm btn btn-danger"> Hapus </a>
                    <form id="hapus-form{{$paket->id}}" action="{{ route('paket.hapus', ['id'=> $paket->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                    </form>
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
        <h4 class="modal-title" id="modal-title"> Tambah Paket</h4>
      </div>
      <form class="form-horizontal" action="{{route('paket.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="nama_paket" class="col-md-3 control-label">Nama Paket</label>
            <div class="col-md-8">
            <input type="text" class="form-control" name="nama_paket" placeholder="Nama Paket" value="{{old('nama_paket')}}" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="lokasi" class="col-md-3 control-label">Lokasi Paket</label>
            <div class="col-md-8">
            <select class="form-control" id="lokasi" name="lokasi" required>
              <option selected disabled> Pilih Lokasi Operasional</option>
              @foreach($lokasis as $lokasi)
              <option value="{{$lokasi->id}}">{{$lokasi->wilayah.' - '.$lokasi->lokasi}}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="deskripsi" class="col-md-3 control-label">Deskripsi Paket</label>
            <div class="col-md-8">
            <textarea type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Paket" required>{{old('deskripsi')}}</textarea>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Tambah Paket</button>
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
