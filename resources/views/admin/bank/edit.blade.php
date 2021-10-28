@extends('admin.layout.app')

@section('content')

@php
$bank = $data['bank'];
@endphp

<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>bank</h3>
    </div>
  </div>

  <div class="clearfix"></div>
 
<form method="post" action="{{ url('admin/bank/update/'.$bank->id_bank) }}" enctype="multipart/form-data">
  @csrf
  
    <div class="x_panel">
      <div class="x_title">
        <h2>Edit Bank</h2>
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
           <label class="control-label col-md-4 col-sm-4 col-xs-12">Kode Bank</label>
           <div class="col-md-8 col-sm-8 col-xs-12">
            <input type="text" name="kode_bank" value="{{ $bank->kode_bank }}" class="form-control" required="">
           @error('kode_bank')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
           </div>
         </div>
         <div class="form-group">
           <label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Bank</label>
           <div class="col-md-8 col-sm-8 col-xs-12">
           <input type="text" name="nama_bank" value="{{ $bank->nama_bank }}" class="form-control" required="">
           </div>
           @error('nama_bank')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="form-group">
           <label class="control-label col-md-4 col-sm-4 col-xs-12">Rekening</label>
           <div class="col-md-8 col-sm-8 col-xs-12">
           <input type="text" name="rekening" value="{{ $bank->rekening }}" class="form-control" required="">
           </div>
           @error('rekening')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="form-group">
           <label class="control-label col-md-4 col-sm-4 col-xs-12">Atas Nama</label>
           <div class="col-md-8 col-sm-8 col-xs-12">
           <input type="text" name="atas_nama" value="{{ $bank->atas_nama }}" class="form-control" required="">
           </div>
           @error('atas_nama')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
          <button type="submit" class="btn btn-success"><i class="fa fa-hdd-o"></i> Simpan Perubahan </button>
       </div>
      </div>

    </div>
</form>

</div>

@endsection