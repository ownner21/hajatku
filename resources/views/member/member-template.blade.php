<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background-color: rgb(220, 220, 220">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand">
                       <img src="{{asset('images/tampilan/s.png')}}" style="width: 100px;">
                    </a>

                  
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <!-- /input-group -->
                    <form class="navbar-form navbar-left">
                         <div class="input-group" style="margin-top: 8px;  width: 600px;">
                        <input type="text" class="form-control" placeholder="Cari Produk atau Jasa">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">Cari</button>
                            </span>
                    </div>
                      </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{Auth::user()->nama}} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('member.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                            {{-- <li><a href="{{url('member/topup')}}">Saldo <span class="badge"></span></a></li> --}}
                            <li><a href="{{url('member/cart')}}">Keranjang</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <!-- Authentication Links -->
                            <li><a href="{{url('member')}}">Dasboard</a></li>
                            <li><a href="{{url('member/topup')}}">Topup</a></li>
                            <li><a href="{{url('member/produk')}}">Produk</a></li>
                            <li><a href="{{url('member/paket')}}" >Paket</a></li>
                            <li><a href="{{url('member/transaksi')}}">Transaksi</a></li>
                            <li><a href="{{url('member/penjualan')}}">Penjualan</a></li>
                    </ul>
                </div>
            </div>
        </nav>                     
        <div class="container">
            <img class="img-rounded" src="{{asset('images/tampilan/tampilansementara.PNG')}}" style="width: 1145px; height: 300px; margin-bottom: 25px;">
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <p style="margin-left: 15px; margin-top: 10px;">Kategori</p>
                    <div class="list-group">
                      <a href="{{url('member')}}" class="list-group-item">Dasboard</a>
                      <a href="{{url('member/topup')}}" class="list-group-item">Topup</a>
                      <a href="{{url('member/produk')}}" class="list-group-item">Produk</a>
                      <a href="{{url('member/paket')}}" class="list-group-item">Paket</a>
                      <a href="{{url('member/transaksi')}}" class="list-group-item">Transaksi</a>
                      <a href="{{url('member/penjualan')}}" class="list-group-item">Penjualan</a>
                    </div>
                </div>
                <div class="col-sm-9">
                     @yield('content')
                </div>
            </div>
        </div>


    </div>
    <!-- Footer -->
    <footer class="page-footer font-small blue-grey lighten-5"  style="background-color: rgb(220, 220, 220)">

    <div>
      <div class="container">

        <!-- Grid row-->
        <div class="row py-4 d-flex align-items-center">

          <!-- Grid column -->
          <div class="col-md-45 text-center text-md-left mb-4 mb-md-0">
            <h4 class="mb-0">Contact</h4>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5" style="margin-top: 10px;">

      <!-- Grid row -->
      <div class="row mt-3 dark-grey-text">

        <!-- Grid column -->
        <div>

          <!-- Content -->
          <p>+6285 732 039 619</p>
          <p>hajatku.noreply@gmail.com</p>
        </div>
      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center text-black-50 py-3" style="margin-top: 20px;">© 2018 Copyright:
      <a class="dark-grey-text" href="https://mdbootstrap.com/education/bootstrap/"> Hajatku.com</a>
    </div>
    <!-- Copyright -->

    </footer>
    <!-- Footer -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
