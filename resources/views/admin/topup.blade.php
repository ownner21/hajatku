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
                <th>Bank</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($topups as $topup)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$topup->bank}}</td>
                <td>{{$topup->nominal}}</td>
                <td>{{$topup->status}}</td>
                <td>
                    @if($topup->status == 'Pengajuan')
                     <a onclick="event.preventDefault(); document.getElementById('konfirmasi-form{{$topup->id}}').submit();" class="btn-sm btn btn-success"> Konfirmasi </a>
                    <form id="konfirmasi-form{{$topup->id}}" action="{{ route('topup.konfirmasi', ['id'=> $topup->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}{{ method_field('PUT') }}
                    </form>
                    <a onclick="event.preventDefault(); document.getElementById('konfirmasi-form{{$topup->id}}').submit();" class="btn-sm btn btn-danger"> Gagal </a>
                    <form id="konfirmasi-form{{$topup->id}}" action="{{ route('topup.gagal', ['id'=> $topup->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}{{ method_field('PUT') }}
                    </form>
                    @else
                    -
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
            
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection