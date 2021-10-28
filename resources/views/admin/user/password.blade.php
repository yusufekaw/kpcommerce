@extends('admin.layout.app')

@section('content')

@php
$useradmin = $data['useradmin'];
@endphp

<form method="post" action="{{ url('admin/useradmin/update/password/'.$useradmin->id_user) }}" enctype="multipart/form-data">
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
		    <h2>Ganti Password User Admin</h2>
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

		  </div>
		</div>
	</div>
</div>

</div>
</form>
@endsection