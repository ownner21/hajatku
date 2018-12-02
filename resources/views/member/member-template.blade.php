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
        <nav class="navbar navbar-default navbar-static-top" style="background-color: rgb(20, 20, 60)">
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
                       HAJATKU
                    </a>
                    <input style="margin-top: 10px; margin-left: 100px; width: 300px;" placeholder="Cari">
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    </ul>

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
                            <li><a href="{{url('member/cart')}}">Cart</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="container"  style="margin-left: 195px;">
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left" style="margin-left: -110px;">
                        <!-- Authentication Links -->
                            <li><a href="{{url('member')}}">Dasboard</a></li>
                            <li><a href="{{url('member/produk')}}">Produk</a></li>
                            <li><a href="{{url('member/paket')}}" >Paket</a></li>
                            <li><a href="{{url('member/transaksi')}}">Transaksi</a></li>
                            <li><a href="{{url('member/penjualan')}}">Penjualan</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="list-group">
                      <a href="{{url('member')}}" class="list-group-item">Dasboard</a>
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
