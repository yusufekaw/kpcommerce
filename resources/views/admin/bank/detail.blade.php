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
 
    @if(session()->get('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ session()->get('success') }}  
    </div>
    @endif
    <div class="x_panel">
      <div class="x_title">
        <h2>Detail bank</h2>
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
          <img src="{{ asset($bank->logo) }}" style="max-width: 100%; max-height: 100%">
          <form method="post" action="{{ url('admin/bank/logo/update/'.$bank->id_bank) }}" enctype="multipart/form-data">
            @csrf
          <label class="btn"> Ganti Logo
            <input type="file" name="logo" style="visibility: hidden;" onchange="form.submit();">
          </label>
          </form>
        </div>
        <div class="col-md-8 col-sm-12">
           <table class="table table-striped table-responsive" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <th>Kode Bank</th>
              <td>{{ $bank->kode_bank }}</td>
            </tr>
            <tr>
              <th>Nama Bank</th>
              <td>{{ $bank->nama_bank }}</td>
            </tr>
            <tr>
              <th>Rekening</th>
              <td>{{ $bank->rekening }}<br>A/N {{ $bank->atas_nama }}</td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
      </div>
    </div>

</div>

@endsection