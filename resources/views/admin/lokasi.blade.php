@extends('admin.admin-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Lokasi 

          <span style="float: right">

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah</button>

          </span>
          </div>
          <div class="panel-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {!! session('status') !!}
                  </div>
              @endif
              
              <div class="row">
                <div class="col-sm-12 col-md-4">
                   Wilayah ini sebah pilihan
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Wilayah</th>
                <th>Lokasi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($lokasis as $lokasi)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$lokasi->wilayah}}</td>
                <td>{{$lokasi->lokasi}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalupdate"
                     data-id="{{$lokasi->id}}" 
                     data-wilayah="{{$lokasi->wilayah}}"  
                     data-lokasi="{{$lokasi->lokasi}}" 
                     >Update</button>
                     <a onclick="event.preventDefault(); document.getElementById('hapus-form{{$lokasi->id}}').submit();" class="btn-sm btn btn-danger"> Hapus </a>
                    <form id="hapus-form{{$lokasi->id}}" action="{{ route('lokasi.hapus', ['id'=> $lokasi->id]) }}" method="POST" style="display: none;">
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
        <h4 class="modal-title" id="modal-title"> Tambah Lokasi</h4>
      </div>
      <form action="{{route('lokasi.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="wilayah" class="control-label">Wilayah:</label>
            <input type="text" class="form-control" id="wilayah" name="wilayah" placeholder="Wilayah">
          </div>
          <div class="form-group">
            <label for="lokasi" class="control-label">Status:</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi">
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
      <form action="{{route('lokasi.update')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="wilayah" class="control-label">Wilayah:</label>
            <input type="text" class="form-control" id="wilayah" name="wilayah">
          </div>
          <div class="form-group">
            <label for="lokasi" class="control-label">Lokasi:</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi">
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
  var wilayah = button.data('wilayah')
  var lokasi = button.data('lokasi')
  var modal = $(this)

  modal.find('.modal-title').text('Update Lokasi ' + wilayah)
  modal.find('#id').val(id)
  modal.find('#wilayah').val(wilayah)
  modal.find('#lokasi').val(lokasi)
})
</script>
@endsection