@extends('member.member-template')

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
                  <b>Saldo Anda Sekarang {{$saldomember->saldo_akhir}} </b> <br>
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
                <td>{{$saldo->keterangan}}</td>
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