@extends('admin.layout.app')

@section('content')

@php
$kontak = $data['kontak'];
@endphp

<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>kontak</h3>
    </div>
  </div>

  <div class="clearfix"></div>
 
<form method="post" action="{{ url('admin/toko/kontak/update/'.$kontak->id_kontak) }}" enctype="multipart/form-data">
  @csrf
  
    <div class="x_panel">
      <div class="x_title">
        <h2>Edit kontak</h2>
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

       <div class="form-vertical">

         <div class="form-group">
           <label class="control-label col-md-4 col-sm-4 col-xs-12">Nama kontak</label>
           <div class="col-md-8 col-sm-8 col-xs-12">
           <input type="text" name="nama_kontak" value="{{ $kontak->nama_kontak }}" class="form-control" required="">
           </div>
           @error('nama_kontak')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
           <label class="control-label col-md-4 col-sm-4 col-xs-12">Kontak Info</label>
           <div class="col-md-8 col-sm-8 col-xs-12">
            @if($kontak->jenis_kontak=='email')
           <input type="email" name="kontak_info" value="{{ $kontak->kontak_info }}" class="form-control" required="">
            @else
           <input type="text" name="kontak_info" value="{{ $kontak->kontak_info }}" class="form-control" required="">
            @endif 
           </div>
           @error('nama_kontak')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
           <label class="control-label col-md-4 col-sm-4 col-xs-12">Link</label>
           <div class="col-md-8 col-sm-8 col-xs-12">
           <input type="url" id="link" name="link" value="{{ $kontak->link }}" class="form-control" required="">
           </div>
          <button type="submit" class="btn btn-success"><i class="fa fa-hdd-o"></i> Simpan Perubahan </button>
       </div>
      </div>

    </div>
</form>

</div>

@endsection