@extends('admin.admin-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Member 

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
                   Daftar Member yang telah bergabung
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($members as $member)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$member->nama}}</td>
                <td>{{$member->email}}</td>
                <td>{{$member->alamat}}</td>
                <td>{{$member->status}}</td>
                <td>
                  @if($member->status=='Aktif')
                  <a href="{{url('admin/member/blok/'.$member->id)}}" class="btn btn-danger btn-sm">Blok Member ini</a>
                  @else
                  <a href="{{url('admin/member/aktif/'.$member->id)}}" class="btn btn-danger btn-sm">Aktifkan Member</a>
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