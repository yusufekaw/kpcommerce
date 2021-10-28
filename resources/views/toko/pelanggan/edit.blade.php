@extends('toko.layouts.app')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<div id="contact-page-contain">
		   <div class="container">
		    
		     
		     <div class="contact-submit">
		       <form method="post" action="{{ url('pelanggan/update/'.Auth::user()->id_user) }}">
		       	@csrf
		         <div class="row">
		           <div class="col-md-6 col-sm-12">
		             <div class="input-group">
		             	<label class="form-control" >Nama Depan *</label>
		               <input type="text" name="nama_depan" value="{{ Auth::user()->nama_depan }}" class="form-control" required>
		               @error('nama_depan')
		               <p class="text-danger">{{ $message }}</p>
		               @enderror
		             </div>
		           </div>
		           <div class="col-md-6 col-sm-12">
		             <div class="input-group">
		             	<label class="form-control" >Nama Belakang *</label>
		               <input type="text" name="nama_belakang" value="{{ Auth::user()->nama_belakang }}" class="form-control" placeholder="Nama Belakang *" required>
		             </div>
		             @error('nama_depan')
		               <p class="text-danger">{{ $message }}</p>
		               @enderror
		           </div>
		           <div class="col-md-6 col-sm-12">
		             <div class="input-group">
		             	<label class="form-control" >Email *</label>
		               <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email *"  required>
		             </div>
		             @error('nama_depan')
		               <p class="text-danger">{{ $message }}</p>
		               @enderror
		           </div>
		           <div class="col-md-6 col-sm-12">
		             <div class="input-group">
		             <label class="form-control" >Jenis Kelamin *</label>
		               <label class="form-control">
		               		<input type="radio" name="gender" value="l" required> Laki-laki
		               		<input type="radio" name="gender" value="p" required> Perempuan
		               </label>
		             </div>
		             @error('nama_depan')
		               <p class="text-danger">{{ $message }}</p>
		               @enderror
		           </div>
		           <div class="col-md-12">
		             <div class="col-md-12 text-center">
		               <button class="btn btn-primary" type="submit"><i class="fa fa-hdd-o"></i> Update </button>
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