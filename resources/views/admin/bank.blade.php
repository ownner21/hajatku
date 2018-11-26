@extends('admin.admin-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Bank

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
                <div class="col-sm-12 col-md-8">
                   Nama dan Nomor Rekening akan tampil jika dalam status tampil
                </div>
              </div>

          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Bank</th>
                <th>Nomor Rekening</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($banks as $bank)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$bank->bank}}</td>
                <td>{{$bank->no_rek}}</td>
                <td>{{$bank->status}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalupdate"
                     data-id="{{$bank->id}}"
                     data-bank="{{$bank->bank}}"
                     data-norek="{{$bank->no_rek}}"
                     data-status="{{$bank->status}}"
                     >Update</button>
                     <a onclick="event.preventDefault(); document.getElementById('hapus-form{{$bank->id}}').submit();" class="btn-sm btn btn-danger"> Hapus </a>
                    <form id="hapus-form{{$bank->id}}" action="{{ route('bank.hapus', ['id'=> $bank->id]) }}" method="POST" style="display: none;">
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
      <form action="{{route('bank.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="bank" class="control-label">Nama Bank</label>
            <input type="text" class="form-control" id="bank" name="bank" placeholder="Nama Bank">
          </div>
          <div class="form-group">
            <label for="no_rek" class="control-label">No Rekening</label>
            <input type="text" class="form-control" id="no_rek" name="no_rek" placeholder="No Rekening">
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
      <form action="{{route('bank.update')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="bank" class="control-label">Nama Bank:</label>
            <input type="text" class="form-control" id="upbank" name="bank">
          </div>
          <div class="form-group">
            <label for="upno_rek" class="control-label">No Rekening:</label>
            <input type="text" class="form-control" id="upno_rek" name="no_rek">
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
  var bank = button.data('bank')
  var norek = button.data('norek')
  var status = button.data('status')
  var modal = $(this)

  modal.find('.modal-title').text('Update Bank ' + bank)
  modal.find('#id').val(id)
  modal.find('#upbank').val(bank)
  modal.find('#upno_rek').val(norek)
  modal.find('#status').val(status)
})
</script>
@endsection
