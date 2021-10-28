@extends('admin.layout.app')

@section('content')

@php
  $kategori = $data['kategori_edited']
@endphp
<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>Edit Kategori Produk</h3>
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

  <div class="clearfix"></div>

  <div class="row">
    
    

    <div class="col-md-12 col-sm-5 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Edit Kategori</h2>
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
          <form method="post" action="{{ url('admin/kategori/update/'.$kategori->id_kategori) }}" class="form-horizontal form-label-left">
            @csrf
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Kategori</label>

              <div class="col-sm-9">
               
                <div class="input-group">
                  <input type="text" class="form-control" name="nama_kategori" value="{{ $kategori->nama_kategori }}">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </span>
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
