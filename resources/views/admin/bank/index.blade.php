@extends('admin.layout.app')

@section('content')

@php
$bank = $data['bank'];
@endphp
<div class="clearfix"></div>
 
<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>bank</h3>
    </div>
  </div>

  <div class="clearfix"></div>
 
<div class="row">
  
  <div class="col-md-7 col-sm-7">
    @if(session()->get('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ session()->get('success') }}  
    </div>
    @endif
    <div class="x_panel">
      <div class="x_title">
        <h2>Semua bank</h2>
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
      <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Bank</th>
              <th>Rekening</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          @foreach($bank as $bank)
          <tr>
            <td>
              <a href="{{ url('admin/bank/detail/'.$bank->id_bank) }}">{{ $bank->id_bank }}</a>
            </td>
            <td>{{ $bank->nama_bank }}</td>
            <td>{{ $bank->rekening }}<br>A/N {{ $bank->atas_nama }}</td>
            <td>
              <a href="{{ url('admin/bank/edit/'.$bank->id_bank) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a href="{{ url('admin/bank/delete/'.$bank->id_bank) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>


      </div>
    </div>
  </div>
<form method="post" action="{{ url('admin/bank/save') }}" enctype="multipart/form-data">
  @csrf
  <div class="col-md-5 col-sm-5">

    <div class="x_panel">
      <div class="x_title">
        <h2>Tambah Bank</h2>
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
           <label>Kode Bank</label>
           <input type="text" name="kode_bank" value="{{ old('kode_bank') }}" class="form-control" required="">
           @error('kode_bank')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="form-group">
           <label>Nama Bank</label>
           <input type="text" name="nama_bank" value="{{ old('nama_bank') }}" class="form-control" required="">
           @error('nama_bank')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="form-group">
           <label>Rekening</label>
           <input type="text" name="rekening" value="{{ old('rekening') }}" class="form-control" required="">
           @error('rekening')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="form-group">
           <label>Atas Nama</label>
           <input type="text" name="atas_nama" value="{{ old('atas_nama') }}" class="form-control" required="">
           @error('atas_nama')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="form-group">
           <label>Logo</label>
           <input type="file" name="logo" value="{{ old('logo') }}" class="form-control" required="">
           @error('logo')
           <span class="text text-danger">{{ $message }}</span>
           @enderror
         </div>
          <button type="submit" class="btn btn-success"><i class="fa fa-hdd-o"></i> Simpan </button>
       </div>
      </div>

    </div>
  </div>
</form>
</div>

</div>

@endsection