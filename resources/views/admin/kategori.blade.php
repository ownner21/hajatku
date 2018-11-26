@extends('admin.admin-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Kategori

          <span style="float: right">

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah</button>

          </span>
          </div>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="panel-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {!! session('status') !!}
                  </div>
              @endif

              <div class="row">
                <div class="col-sm-12 col-md-4">
                   Kategori ini akan tampil pada menu utama
                </div>
              </div>

          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($kategoris as $kategori)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$kategori->kategori}}</td>
                <td>{{$kategori->status}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalupdate"
                     data-id="{{$kategori->id}}"
                     data-kategori="{{$kategori->kategori}}"
                     data-status="{{$kategori->status}}"
                     >Update</button>
                     <a onclick="event.preventDefault(); document.getElementById('hapus-form{{$kategori->id}}').submit();" class="btn-sm btn btn-danger"> Hapus </a>
                    <form id="hapus-form{{$kategori->id}}" action="{{ route('kategori.hapus', ['id'=> $kategori->id]) }}" method="POST" style="display: none;">
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
        <h4 class="modal-title" id="modal-title"> Tambah Kategori</h4>
      </div>
      <form action="{{route('kategori.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="kategori" class="control-label">Kategori:</label>
            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Status:</label>
             <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="status">
                  <option disabled="">Pilih Status</option>
                  <option value="Tampil">Tampil</option>
                  <option value="Sembunyi">Sembunyi</option>
                </select>
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
      <form action="{{route('kategori.update')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Kategori:</label>
            <input type="text" class="form-control" id="kategori" name="kategori">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Status:</label>
             <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="status">
                  <option disabled="">Pilih Status</option>
                  <option value="Tampil">Tampil</option>
                  <option value="Sembunyi">Sembunyi</option>
                </select>
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
  var kategori = button.data('kategori')
  var status = button.data('status')
  var modal = $(this)

  modal.find('.modal-title').text('Update Kategori ' + kategori)
  modal.find('#id').val(id)
  modal.find('#kategori').val(kategori)
  modal.find('#status').val(status)
})
</script>
@endsection
