@extends('member.member-template')

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Topup 

          <span style="float: right">

            <a href="{{url('member/saldo')}}" class="btn btn-sm btn-warning">Saldo</a>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Topup</button>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bs-example-info-sm">Info</button>

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
                  <b>Saldo Anda Sekarang {{$saldo}} </b> <br>
                   Riwayat Top Anda
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
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
<div class="modal fade bs-example-info-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title"> Info</h4>
      </div>
      <div class="modal-body">
        <p>Berikut nomor rekening sesuai dengna nama bank. silahkan mentansfer sesuai dengan Bank pilihan</p>
        <table class="table">
          <tr> <th>Mandiri</th> <td>1892710209</td> </tr>
          <tr> <th>BCA</th> <td>164510209</td> </tr>
          <tr> <th>BNI</th> <td>1423710209</td> </tr>
          <tr> <th>BRI</th> <td>10912983009</td> </tr>
          <tr> <th>Bank Jatim</th> <td>1986709</td> </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title"> Topup Sekarang</h4>
      </div>
      <form action="{{route('topup.tambah')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="wilayah" class="control-label">Bank:</label>
             <select class="form-control" name="bank" required>
              <option selected disabled> Pilih Bank</option>
              <option class="Mandiri">Mandiri</option>
              <option class="BCA">BCA</option>
              <option class="BNI">BNI</option>
              <option class="BRI">BRI</option>
              <option class="Bank Jatim">Bank Jatim</option>
            </select>
          </div>
          <div class="form-group">
            <label for="lokasi" class="control-label">Nominal:</label>
            <select class="form-control" name="nominal" required="">
              <option selected disabled> Pilih Nominal</option>
              <option value="50000">50.000</option>
              <option value="100000">100.000</option>
              <option value="200000">200.000</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Topup Sekerang</button>
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