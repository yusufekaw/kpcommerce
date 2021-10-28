@extends('admin.layout.app')

@section('content')

@php
$useradmin = $data['useradmin'];
@endphp

<style type="text/css">
	.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
</style>

<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>User Admin</h3>
    </div>
  </div>

  <div class="clearfix"></div>
 
<div class="row">
	<div class="col-md-12 col-sm-12">
		@if(session()->get('success'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ session()->get('success') }}  
		</div>
		@endif
		<div class="x_panel">
		  <div class="x_title">
		    <h2>Detail User Admin</h2>
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
		  	<div class="pull-right">
		  		@if(AUth::user()->id_user != $useradmin->id_user)
		  		<a href="{{ url('admin/useradmin/edit/'.$useradmin->id_user) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah Profil</a>
		  		<a href="{{ url('admin/useradmin/edit/password/'.$useradmin->id_user) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Ganti Password</a>
		  		@else
		  		<a href="{{ url('admin/useradmin/login/edit/') }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah Profil</a>
		  		<a href="{{ url('admin/useradmin/login/password/edit/') }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Ganti Password</a>
		  		@endif
		  	</div>
		  	<div class="row">
		  		<div class="col-md-4 col-sm-12">
		  			
		  			<img src="{{ asset($useradmin->avatar) }}" style="max-width: 100%; max-height: 100%;">
		  			<form method="post" action="{{ url('admin/useradmin/avatar/update/'.$useradmin->id_user) }}" enctype="multipart/form-data">
		  				@csrf
		  			<label class="btn"> Ganti foto
		  				<input type="file" name="avatar" style="visibility: hidden;" onchange="form.submit();">
		  			</label>
		  			</form>
		  		</div>
		  		<div  class="col-md-8 col-sm-12">
		  			<table class="table table-responsive table-striped">
		  				<tr>
		  					<th>Nama</th>
		  					<td>{{ $useradmin->nama_depan.' '.$useradmin->nama_belakang }}</td>
		  				</tr>
		  				<tr>
		  					<th>Email</th>
		  					<td>{{ $useradmin->email }}</td>
		  				</tr>
		  				<tr>
		  					<th>Role</th>
		  					<td>{{ $useradmin->role }}</td>
		  				</tr>
		  				<tr>
		  					<th>gender</th>
		  					<td>
		  						@if($useradmin->gender == 'l')
		  						Laki-laki
		  						@else
		  						Perempuan
		  						@endif
		  					</td>
		  				</tr>
		  			</table>	
		  		</div>
		  	</div>		 
		  </div>
		</div>
	</div>
</div>

</div>

@endsection
  