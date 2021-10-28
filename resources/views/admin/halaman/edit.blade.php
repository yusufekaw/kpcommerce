@extends('admin.layout.app')

@section('content')
@php 
$halaman = $data['halaman'];
@endphp
<form method="post" action="{{ url('admin/halaman/update/'.$halaman->id_halaman) }}">
	@csrf
<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>Halaman</h3>
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
		    <h2>Edit Halaman</h2>
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
		  	<div class="form-horizontal form-label-left">
		  		<div class="form-group">
		  			<label>Judul</label>
		  			<input type="text" name="judul" class="form-control" value="{{ $halaman->judul }}" required>
		  			@error('judul')
		  			<span class="text text-danger">{{ $message }}</span>
		  			@enderror
		  		</div>
		  		<div class="form-group">
		  			<label>Konten</label>
		  			<textarea id="konten" class="form-control" name="konten" rows="10" cols="50" required>{{ $halaman->konten }}</textarea>
		  			@error('konten')
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
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<!--script src="http://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script-->

<script>
  var konten = document.getElementById("konten");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
</script>

@endsection