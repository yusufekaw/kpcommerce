@extends('toko.layouts.app')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<div id="contact-page-contain">
		   <div class="container">
		    
		     
		     <div class="contact-submit">
		       <form method="post" action="{{ url('pelanggan/update/password/'.Auth::user()->id_user) }}">
		       	@csrf
		         <div class="row">
		           <div class="col-md-12 col-sm-12">
		             <div class="input-group">
		             	<label class="form-control" >Password Lama *</label>
		               <input type="password" name="password_lama" class="form-control" required>
		             </div>
		             @error('password_lama')
		             <p class="text-danger">{{ $message }}</p>
		             @enderror
		             @if(session()->get('error'))
		             <p class="text-danger">
		             	{{ session()->get('error') }}
		             </p>
		             @endif
		           </div>
		           <div class="col-md-12 col-sm-12">
		            <div class="input-group">
		             	<label class="form-control">Password baru *</label>
		               <input type="password" name="password_baru" class="form-control" required>
		            </div>
		            @error('password_baru')
		           	<p class="text-danger">{{ $message }}</p>
		           	@enderror
		           </div>
		           <div class="col-md-12 col-sm-12">
		             <div class="input-group">
		             	<label class="form-control">Konfirmasi password *</label>
		               <input type="password" name="konfirmasi_password"  class="form-control" >
		             </div>
		             @error('konfirmasi_password')
		           	<p class="text-danger">{{ $message }}</p>
		           	@enderror
		           </div>
		           <div class="col-md-12">
		             <div class="col-md-12 text-center">
		               <button class="btn btn-primary" type="submit"><i class="fa fa-hdd-o"></i> Update Password</button>
		             </div>
		           </div>
		         </div>
		       </form>
		     </div>
		     
		   </div>
		 </div>
	</div>
</div>
	

@endsection