@extends('admin.layout.app')

@section('content')

<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>Halaman</h3>
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
		    <h2>Semua Halaman</h2>
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
		  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
		      <thead>
		        <tr>
		          <th>ID Halaman</th>
		          <th>Judul</th>
		          <th>Aksi</th>
		        </tr>
		      </thead>
		      <tbody>
		    	@foreach($data['halaman'] as $halaman)
		    	<tr>
		    		<td>
		    			<a href="{{ url('admin/halaman/'.$halaman->id_halaman) }}">{{ $halaman->id_halaman }}</a>
		    		</td>
		    		<td>{{ $halaman->judul }}</td>
		    		<td>
		    			<a href="{{ url('admin/halaman/edit/'.$halaman->id_halaman) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
		    			<a href="{{ url('admin/halaman/delete/'.$halaman->id_halaman) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
		    		</td>
		    	</tr>
		    	@endforeach
		      </tbody>
		    </table>


		  </div>
		</div>
	</div>
</div>

</div>

@endsection