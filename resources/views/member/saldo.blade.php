@extends('member.member-template')

@section('menu')
<div class="list-group">
  <a href="{{url('member/topup')}}" class="list-group-item list-group-item-action ">
    Topup
  </a>
  <a href="#" class="list-group-item list-group-item-action active">Saldo</a>
  <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target=".bs-example-modal-sm">Topup</a>
  <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target=".bs-example-info-sm">Info</a>
</div>
@endsection

@section('content')
  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Riwayat Saldo 

          <span style="float: right">
          </span>
          </div>
          <div class="panel-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}
                  </div>
              @endif
              
              <div class="row">
                <div class="col-sm-12">
                  <b>Saldo Anda Sekarang {{$saldomember}} </b> <br>
                   Riwayat Pemasukan Dan Pengeluaran Saldo Anda
                </div>
              </div>
             
          </div>
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center">#</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Saldo Akhir</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php $n= 1; ?>
              @foreach($saldos as $saldo)
              <tr>
                <td style="text-align: center">{{$n++}}</td>
                <td>{{$saldo->debit}}</td>
                <td>{{$saldo->kredit}}</td>
                <td>{{$saldo->saldo_akhir}}</td>
                <td>{{$saldo->updated_at}} <br>{{$saldo->keterangan}}</td>
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
          @foreach($banks as $bank)
          <tr> <th>{{$bank->bank}}</th> <td>{{$bank->no_rek}}</td> </tr>
          @endforeach
        </table>
        <p><b>Harap Mencantumkan Nomor TOPUP pada deskripsi anda pada saat transfer ke BANK </p>
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
              @foreach($banks as $bank)
              <option value="{{$bank->bank.' - '.$bank->no_rek}}">{{$bank->bank}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="lokasi" class="control-label">Nominal:</label>
            <select class="form-control" name="nominal" required="">
              <option selected disabled> Pilih Nominal</option>
              <option value="50000">50.000</option>
              <option value="100000">100.000</option>
              <option value="200000">200.000</option>
              <option value="500000">500.000</option>
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