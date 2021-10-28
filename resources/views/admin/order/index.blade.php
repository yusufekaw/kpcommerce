@extends('admin.layout.app')

@section('content')

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
          <h2>Semua Order</h2>
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
          <form class="form-inline" method="post" action="{{ url('admin/order/filter/tanggal') }}">
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
          
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID Order</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Tanggal Order</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['order'] as $order)
              <tr>
                <td>
                  <a href="{{ url('admin/order/detail/'.$order->id_order) }}">{{ $order->id_order }}</a>  
                </td>
                <td>{{ $order->nama }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->tanggal }}</td>
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