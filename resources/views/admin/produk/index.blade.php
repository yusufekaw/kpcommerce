@extends('admin.layout.app')

@section('content')

 <div class="right_col" role="main">
 	<div class="page-title">
 		<div class="title_left">
 			<h3> {{ $data['title'] }} </h3>
 		</div>

 		<!--div class="title_right">
 			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
 				<div class="input-group">
 					<input type="text" class="form-control" placeholder="Search for...">
 					<span class="input-group-btn">
 						<button class="btn btn-default" type="button">Go!</button>
 					</span>
 				</div>
 			</div>
 		</div-->
 	</div>

 	<div class="row">
 		<div class="col-md-12">
 			@if(session()->get('success'))
 			   <div class="alert alert-success alert-dismissible">
 			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
 			        {{ session()->get('success') }}  
 			    </div>
 			@endif
 			<div class="x_panel">
 				<div class="x_title">
 					<h2>{{ $data['title'] }}</h2>
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

 						@foreach($data['produk'] as $produk)
 						<div class="col-lg-3">
 							<div class="thumbnail">
 								<div class="image view view-first">
 									<img style="width: 100%; display: block;" src="{{ asset($produk->gambar) }}" alt="image" />
 									<div class="mask">
 										<p>Stok {{ $produk->stok }} | Rp. {{ number_format($produk->harga,2,',','.') }}</p>
 										<div class="tools tools-bottom">
 											<a href="{{ url('admin/produk/detail/'.$produk->id_produk) }}"><i class="fa fa-link"></i></a>
 											<a href="{{ url('admin/produk/edit/'.$produk->id_produk) }}"><i class="fa fa-pencil"></i></a>
 											<a href="{{ url('admin/produk/delete/'.$produk->id_produk) }}"><i class="fa fa-times"></i></a>
 										</div>
 									</div>
 								</div>
 								<div class="caption">
 									<p align="center"><b>{{ substr($produk->nama_produk,0,15) }}</b></p>
 									<p>Kategori : {{ substr($produk->nama_kategori,0,15) }}</p>
 								</div>
 							</div>
 						</div>
 						@endforeach
 						
 					</div>
 					<div class="pull-right"> 							
 						{!! $data['produk']->render() !!}
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>

@endsection