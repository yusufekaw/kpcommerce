@extends('toko.layouts.app')
@section('content')
<!--================login_part Area =================-->
   <!--================login Area =================-->
        <section class="login_area p_100">
            <div class="container">
                <div class="login_inner">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="login_title">
                                <h2>log in your account</h2>
                                <p>Log in to your account to discovery all great features in this template.</p>
                            </div>
                            <form class="login_form row">
                                <div class="col-lg-12 form-group">
                                    <input class="form-control" type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-control" type="text" placeholder="User Name">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="creat_account">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Keep me logged in</label>
                                        <div class="check"></div>
                                    </div>
                                    <h4>Forgot your password ?</h4>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn update_btn form-control">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <div class="login_title">
                                <h2>Bikin Akun</h2>
                                <p>Gak punya akun, gak bisa belanja lho! Yuks bikin akun sekarang.</p>
                            </div>
                            <form method="post" action="{{ url('pelanggan/save') }}">

                                @csrf
  												  	
							  	<div class="form-group row">
    								<label for="nama_depan" class="col-sm-2 col-form-label">Nama depan</label>
							    <div class="col-sm-10">
							      <input type="text" name="nama_depan" id="nama_depan" class="form-control  @error('nama_depan') is-invalid @enderror" placeholder="Nama Depan" required="required" value="{{ old('nama_depan') }}">
                                    @error('nama_depan')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
							    </div>
							  	</div>

							  	<div class="form-group row">
    								<label for="nama-belakang" class="col-sm-2 col-form-label">Nama Belakang</label>
							    <div class="col-sm-10">
							      <input type="text" name="nama_belakang" id="nama_belakang" class="form-control @error('nama_belakang') is-invalid @enderror" placeholder="nama belakang" required="required" value="{{ old('nama_belakang') }}">
                                    @error('nama_belakang')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
							    </div>
							  	</div>

							  	<div class="form-group row">
    								<label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
							    <div class="col-sm-3">
							      <input class="form-check-input" type="radio" name="gender" id="genderl" value="l" required="required"> 
							      <label class="form-check-label" for="genderl">Laki-laki</label>
							    </div>
							    <div class="col-sm-3">
							      <input class="form-check-input" type="radio" name="gender" id="genderp" value="p" required="required"> <label class="form-check-label" for="genderp">Perempuan</label>
							    </div>
							  	</div>

							  	<div class="form-group row">
    								<label for="email" class="col-sm-2 col-form-label">Email</label>
							    <div class="col-sm-10">
							      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required="required" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
							    </div>
							  	</div>

							  <div class="form-group row">
							    <label for="password" class="col-sm-2 col-form-label">Password</label>
							    <div class="col-sm-10">
							      <input type="password" name="password"  id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required="required" value="{{ old('password') }}">
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="konfirmasi_password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
							    <div class="col-sm-10">
							      <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control @error('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password" required="required" value="{{ old('konfirmasi_password') }}">
                                      @error('konfirmasi_password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							    </div>
							  </div>

							  <div class="form-group row">
							    <div class="col-sm-12">
							      <button type="submit" value="submit" class="btn subs_btn form-control">register now</button>
							    </div>
							  </div>

							</form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End login Area =================-->
    <!--================login_part end =================-->

@endsection