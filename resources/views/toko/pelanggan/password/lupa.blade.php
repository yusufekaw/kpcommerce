@extends('toko.layouts.app')

@section('content')

@include('toko.layouts.alert');

 <div id="contact-page-contain">
    <div class="container">

      <div class="contact-submit">
        <form method="post" action="{{ url('pelanggan/lupa_password/kirim') }}">
        	@csrf
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email Kamu *" required>
              </div>
              <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="submit"><i class="fa fa-envelope-o"></i> Kirim Perminataan </button>
              </div>
              <!-- /input-group -->
             
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection