@extends('admin.admin-template')

@section('css')
<style type="text/css">
  
</style>
@endsection


@section('content')

  <div class="row">
    <div class="col-sm-12">
       <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>

          <div class="panel-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              You are logged in! edit disini
          </div>
      </div>
    </div>
  </div>
           

            
@endsection
