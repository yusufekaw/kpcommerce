@extends('admin.layout.app')

@section('content')

@php
$pelanggan = $data['pelanggan'];
$alamat = $data['alamat'];
$order = $data['order_by_user'];
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
		    <h2>Semua User Admin</h2>
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
		  	<div class="row">
		  		<div class="col-md-4 col-sm-12">
		  			
		  			<img src="{{ asset($pelanggan->avatar) }}" style="max-width: 100%; max-height: 100%;">
		  		</div>
		  		<div  class="col-md-8 col-sm-12">
		  			<table class="table table-responsive table-striped">
		  				<tr>
		  					<th>Nama</th>
		  					<td>{{ $pelanggan->nama_depan.' '.$pelanggan->nama_belakang }}</td>
		  				</tr>
		  				<tr>
		  					<th>Email</th>
		  					<td>{{ $pelanggan->email }}</td>
		  				</tr>
		  				<tr>
		  					<th>Role</th>
		  					<td>{{ $pelanggan->role }}</td>
		  				</tr>
		  				<tr>
		  					<th>gender</th>
		  					<td>
		  						@if($pelanggan->gender == 'l')
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
	<div class="col-md-12 col-sm-12">
		<div class="x_panel">
		<div class="x_title">
			<h2><i class="fa fa-bars"></i> Vertical Tabs <small>Float left</small></h2>
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

			<div class="col-xs-3">
				<!-- required for floating -->
				<!-- Nav tabs -->
				<ul class="nav nav-tabs tabs-left">
					<li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Alamat</a>
					</li>
					<li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Order</a>
					</li>
				</ul>
			</div>

			<div class="col-xs-9">
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="home">
						<table class="table table-stripped table-responsive">
						  <tbody>
						    @foreach($alamat as $alamat)
						    <tr>

						      @if($alamat->jalan==null)
						      <td>
						        <span class="fa fa-user"></span>&nbsp;&nbsp;&nbsp; 
						        {{ $alamat->atas_nama.' ('.$alamat->jenis.')' }}  
						        <br> 
						        <span class="fa fa-map-marker"></span>&nbsp;&nbsp;&nbsp; 
						        {{ $alamat->kelurahan }} RT/RW {{ $alamat->rt.'/'.$alamat->rw }}
						        kec. {{ $alamat->kecamatan }}, {{$alamat->kota}}, {{ $alamat->provinsi }}. {{ $alamat->kodepos }}
						        <br> 
						        <span  class="fa fa-phone"></span> &nbsp;{{ $alamat->telp }}

						      </td>
						      @else
						      <td>
						        <span class="fa fa-user"></span>&nbsp;&nbsp;&nbsp;
						        {{ $alamat->atas_nama.' ('.$alamat->jenis.')' }}  
						        <br> 
						        <span class="fa fa-map-marker"></span>&nbsp;&nbsp;&nbsp;
						        {{ $alamat->jalan }}, {{ $alamat->kelurahan }} RT/RW {{ $alamat->rt.'/'.$alamat->rw }}
						        kec. {{ $alamat->kecamatan }}, {{$alamat->nama_kota}}, {{ $alamat->nama_provinsi }}. {{ $alamat->kodepos }}
						        <br> 
						        <span  class="fa fa-phone"></span> &nbsp;&nbsp;&nbsp;{{ $alamat->telp }}
						      </td>
						      @endif
						    </tr>
						    @endforeach
						  </tbody>
						</table>
					</div>
					<div class="tab-pane" id="profile">
						<table class="table table-stripped table-responsive">
						    <thead>
						      <tr>
						        <th>ID</th>
						        <th>Status</th>
						        <th>Tanggal</th>
						      </tr>
						    </thead>
						    <tbody>
						     @foreach($order as $order)
						     <tr>
						       <td>
						        <a href="{{ url('admin/order/detail/'.$order->id_order) }}">
						          {{ $order->id_order }}
						        </a>
						      </td>
						       <td>{{ $order->status }}</td>
						       <td>{{ $order->created_at }}</td>
						     </tr>
						     @endforeach
						    </tbody>
						    <tfoot>
						      <tr>
						        <th>ID</th>
						        <th>Status</th>
						        <th>Tanggal</th>
						      </tr>
						    </tfoot>
						  </table> 
					</div>
				</div>
			</div>
	</div>
	</div>
</div>

</div>

@endsection
  