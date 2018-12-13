@extends('front.front-template')
@section('css')
@endsection

@section('content')

<div class="row" style="margin-top: 140px">
    <div class="col-md-6" style="margin-top: 70px">
    <div class="col-md-9 col-md-offset-2">
        <center>
        <h1 style="font-size: 64px">Hajatku</h1>
        <p>Selamat datang, selamat berbelanja <br> anda senang kamipun senang</p>
        </center>
    </div>  
    </div>
    <div class="col-md-6">
        <div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"><center>Login</center></div>

            <div class="panel-body">
                @if (session('success'))
                  <div class="">
                    <div class="alert alert-success">
                        <center>{{ session('success') }}</center>
                    </div>
                  </div>
                @endif
                @if (session('gagal'))
                  <div class="">
                    <div class="alert alert-danger">
                        <center>{{ session('gagal') }}</center>
                    </div>
                  </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('member.login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label"><i class="material-icons">account_circle</i></label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" placeholder="E-Mail Addres" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label"><i class="material-icons">vpn_key</i></label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" placeholder="password HajatKu" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                               Belum punya akun? <a href="{{ route('member.register') }}">Daftar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

@endsection
@section('script')
@endsection
