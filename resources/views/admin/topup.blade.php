@extends('admin.admin-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Topup 

          <span style="float: right">
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
                    Daftar Member Topup
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Nomor Transaksi</th>
                <th>Member</th>
                <th>Bank</th>
                <th>Nominal</th>
                <th>Pengajuan</th>
                <th>Respon Admin</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($topups as $topup)
              <?php 
                $nama = App\Models\User::find($topup->id_member);
              ?>
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{ sprintf("%05d", $topup->id)}}</td>
                <td>{{(!empty($nama))? $nama->nama: 'NN'}}</td>
                <td>{{$topup->bank}}</td>
                <td>{{$topup->nominal}}</td>
                <td>{{$topup->created_at}}</td>
                <td>{{$topup->updated_at}}</td>
                <td>{{$topup->status}}</td>
                <td>
                    @if($topup->status == 'Pengajuan')
                     <a onclick="event.preventDefault(); document.getElementById('konfirmasi-form{{$topup->id}}').submit();" class="btn-sm btn btn-success"> Konfirmasi </a>
                    <form id="konfirmasi-form{{$topup->id}}" action="{{ route('topup.konfirmasi', ['id'=> $topup->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}{{ method_field('PUT') }}
                    </form>
                    <a onclick="event.preventDefault(); document.getElementById('gagal-form{{$topup->id}}').submit();" class="btn-sm btn btn-danger"> Gagal </a>
                    <form id="gagal-form{{$topup->id}}" action="{{ route('topup.gagal', ['id'=> $topup->id]) }}" method="POST" style="display: none;">
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