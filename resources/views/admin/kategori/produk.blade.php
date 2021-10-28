@extends('admin.layout.app')

@section('content')

 <div class="right_col" role="main">
 	<div class="page-title">
 		<div class="title_left">
 			<h3> Semua Produk di Kategori {{ $data['kategori']->nama_kategori }} </h3>
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
 			<div class="x_panel">
 				<div class="x_title">
 					<h2>Produk di Kategori {{ $data['kategori']->nama_kategori }}</h2>
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
 						<div class="col-md-55">
 							<div class="thumbnail">
 								<div class="image view view-first">
 									<img style="width: 100%; display: block;" src="{{ asset($produk->gambar) }}" alt="image" />
 									<div class="mask">
 										<p>Stok {{ $produk->stok }}</p>
 										<div class="tools tools-bottom">
 											<a href="#"><i class="fa fa-link"></i></a>
 											<a href="#"><i class="fa fa-pencil"></i></a>
 											<a href="#"><i class="fa fa-times"></i></a>
 										</div>
 									</div>
 								</div>
 								<div class="caption">
 									<p>{{ substr($produk->nama_produk,0,15) }}</p>
 									<p>Rp. {{ number_format($produk->harga,2,',','.') }}</p>
 								</div>
 							</div>
 						</div>
 						@endforeach

 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>

@endsection