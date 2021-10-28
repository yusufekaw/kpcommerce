@extends('admin.layout.app')

@section('content')
    


<!-- page content -->
<div class="right_col" role="main">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Grafik Penjualan Produk {{ $data['nama_produk'] }} dalam Kuantitas</h2>
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
          <!--canvas id="produkTerjual"></canvas!-->
          <canvas id="canvas"></canvas>
        </div>
      </div>      
    </div>
  
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Grafik Penjualan Produk {{ $data['nama_produk'] }} dalam Kuantitas</h2>
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
          <!--canvas id="produkTerjual"></canvas!-->
          <canvas id="canvas2"></canvas>
        </div>
      </div>      
    </div>

  </div>



</div>

                  <!-- /page content -->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

<script type="text/javascript">
  var jsonfile = {!! $data['produk'] !!}

  var labels = jsonfile.map(function(e) {
     return e.tanggal;
  });
  var data = jsonfile.map(function(e) {
     return e.terjual;
  });;

  var ctx = canvas.getContext('2d');
  var config = {
     type: 'line',
     data: {
        labels: labels,
        datasets: [{
           label: 'Jumlah Penjualan dalam kuantitas',
           data: data,
           backgroundColor: 'rgba(0, 119, 204, 0.3)'
        }]
     }
  };

  var chart = new Chart(ctx, config);
</script>

<script type="text/javascript">
  var jsonfile = {!! $data['produk'] !!}

  var labels = jsonfile.map(function(e) {
     return e.tanggal;
  });
  var data = jsonfile.map(function(e) {
     return e.total;
  });;

  var ctx = canvas2.getContext('2d');
  var config = {
     type: 'line',
     data: {
        labels: labels,
        datasets: [{
           label: 'Jumlah Penjualan dalam kuantitas',
           data: data,
           backgroundColor: 'rgba(0, 119, 204, 0.3)'
        }]
     }
  };

  var chart = new Chart(ctx, config);
</script>

<script>
                        CKEDITOR.replace( 'editor1' );
                </script>


@endsection