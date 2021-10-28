@extends('admin.layout.app')

@section('content')

<form method="post" action="{{ url('admin/useradmin/save') }}" enctype="multipart/form-data">
	@csrf
<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>User Admin</h3>
    </div>
  </div>

  <div class="pull-right"> 
  	<button type="submit" class="btn btn-success"><i class="fa fa-hdd-o"></i> Simpan</button>
  </div>

  <div class="clearfix"></div>
 
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="x_panel">
		  <div class="x_title">
		    <h2>Tambah User Admin</h2>
		    <ul class="nav navbar-right panel_toolbox">
		      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		      </li>
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		        <ul class="dropdown-menu" role="menu">
		          <li><a href="#">Settings 1</a>
		          </li>
		          <li><a href="#">Settings 2</a>
		          </li>
		        </ul>
		      </li>
		      <li><a class="close-link"><i class="fa fa-close"></i></a>
		      </li>
		    </ul>
		    <div class="clearfix"></div>
		  </div>
		  <div class="x_content">
		  	<div class="form-group">
		  		<label class="control-label col-md-4 for="nama_depan">Nama Depan <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<input type="text" name="nama_depan" id="nama_depan" value="{{ old('nama_depan') }}" required="required" class="form-control col-md-8 col-sm-12">
		  			@error('nama_depan')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label class="control-label col-md-4" for="nama_belakang">Last Name <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<input type="text" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang') }}" required="required" class="form-control col-md-8 col-sm-12">
		  			@error('nama_belakang')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label class="control-label col-md-4" for="email">Email <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<input type="email" id="email" name="email" value="{{ old('email') }}" required="required" class="form-control col-md-8 col-sm-12">
		  			@error('email')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label class="control-label col-md-4" for="gender">Gender <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<div class="radio">
		  				<label class="">
		  					<div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat"  name="gender" value="l" required style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> Laki-laki
		  				</label>
		  				<label class="">
		  					<div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" name="gender" value="p" required style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> Perempuan
		  				</label>
		  				@error('gender')
		  				<span class="text text-danger">{{ $message }}</span>
		  				@enderror
		  			</div>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label class="control-label col-md-4" for="role">Role <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<select id="role" name="role" required="required" class="form-control col-md-8 col-sm-12">
		  				<option value="admin">Admin</option>
		  				<option value="superadmin">Super Admin</option>
		  			</select>
		  			@error('role')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label class="control-label col-md-4" for="password">Password <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<input type="password" id="password" name="password" required="required" class="form-control col-md-8 col-sm-12">
		  			@error('password')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label class="control-label col-md-4" for="password">Konfirmasi Password <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<input type="password" id="konfirmasi_password" name="konfirmasi_password" required="required" class="form-control col-md-8 col-sm-12">
		  			@error('konfirmasi_password')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label class="control-label col-md-4" for="avatar">Foto Profil <span class="required">*</span>
		  		</label>
		  		<div class="col-md-8">
		  			<input type="file" id="avatar" name="avatar" accept="image/*" required="required" class="form-control col-md-8 col-sm-12">
		  			@error('avatar')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  	</div>

		  </div>
		</div>
	</div>
</div>

</div>
</form>
@endsection