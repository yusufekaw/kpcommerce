@extends('admin.layout.app')

@section('content')

@php
$pendapatan = 0;
@endphp

<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3> Order </h3>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Produk Terjual</h2>
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
          <form class="form-inline" method="post" action="{{ url('admin/penjualan/filter/tanggal') }}">
            @csrf
            <div class="form-group">
              <label for="ex3">Dari Tanggal</label>
              <div class='input-group date' id='daritanggal'>
                <input type='text' name="daritanggal" class="form-control" />
                <span class="input-group-addon">
                 <span class="glyphicon glyphicon-calendar"></span>
               </span>
              </div>            
            </div>
            <div class="form-group">
              <label for="ex3">Sampai Tanggal</label>
              <div class='input-group date' id='sampaitanggal'>
                <input type='text' name="sampaitanggal" class="form-control" />
                <span class="input-group-addon">
                 <span class="glyphicon glyphicon-calendar"></span>
               </span>
              </div>            
            </div>
            <button type="submit" class="btn btn-default">Filter</button>
          </form>
          <hr/>
          <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Terjual</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
              </tr>
            </thead>


            <tbody>
              @foreach($data['produk'] as $produk)
              <tr>
                <td>
                  <a href="{{ url('admin/penjualan/detail/'.$produk->id_produk) }}">{{ $produk->produk }}</a></td>
                <td>{{ $produk->terjual }}</td>
                <td>Rp. {{ number_format($produk->total,2,',','.') }}</td>
                <td>{{ $produk->tanggal }}</td>
              </tr>
              @php 
                $pendapatan+=$produk->total;
              @endphp
              @endforeach
            </tbody>
          </table>
          <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <th>Total Pendapatan</th>
                <td>Rp. {{ number_format($pendapatan,2,',','.') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection