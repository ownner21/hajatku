@extends('member.member-template')

@section('content')
  <div class="row">
    @if (session('success'))
      <div class="col-sm-12">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      </div>
    @endif
    @if (session('gagal'))
      <div class="col-sm-12">
        <div class="alert alert-danger">
            {{ session('gagal') }}
        </div>
      </div>
    @endif
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading"><b>Cart</b></div>

          <table class="table">
          	<thead>
          		<tr>
          			<th style="text-align: center;">#</th>
          			<th>Nama Produk</th>
          			<th>Qty</th>
          			<th>Harga</th>
          			<th style="text-align: right;">Jumlah</th>
          			<th></th>
          		</tr>
          	</thead>
          	<tbody>
          		<?php $n= 1;?>
          		@foreach(Cart::content() as $row)
		       
          		<tr>
          			<td style="text-align: center;">{{$n++}}</td>
          			<td>{{$row->name}}</td>
          			<td>{{$row->qty}}</td>
          			<td>{{number_format($row->price,0,",",".")}}</td>
          			<td style="text-align: right;">{{number_format($row->price*$row->qty,0,",",".")}}</td>
	                <td><a href="{{url('member/cart/remove/'.$row->rowId)}}" class="btn btn-danger btn-sm">Hapus</a></td>
          		</tr>
          		
    			    @endforeach

            @if(Cart::count()!=0)
  			    <tr>
  			    	<td colspan="3"></td>
  			    	
  			    	<td>Jumlah Tagihan</td>
  			    	<td style="text-align: right;"><b>{{number_format(str_replace(",","",Cart::subtotal()),0,",",".")}}</b></td>
  	                <td><a href="{{url('member/cart/removeall')}}" class="btn btn-danger btn-sm">Reset</a></td>
  			    </tr>
            @else
            <tr>
              <td colspan="5" style="text-align: center"> Cart Anda Masih Kosong</td>
            </tr>
            @endif
          	</tbody>
          </table>
          <br>
          @if(Cart::count()!=0)
          <div class="panel-body" style="background-color: #0001">
          	<div class="row">
          		<div class="col-sm-8">
          			Sialahkan Melakukan Konfirmasi Pembayaran dengan Menekan Tombol "Lunasi", Saldo Anda akan automatis terpotong. Jika belum melakukan TOPUP silahakn melakukan topup terlebih dahulu
          		</div>
          		<div class="col-sm-4" style="text-align: right;">

          			<a href="{{url('member/cart/lunasi')}}" class="btn btn-lg btn-primary">Lunasi</a>
          		</div>
          	</div>
          </div>
          @endif
      </div>
    </div>
  </div>
           
@endsection
