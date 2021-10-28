<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Panel Admin CVB </title>

    <!-- Bootstrap -->
    <link href="{{ asset('gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('gentelella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('gentelella/build/css/custom.min.css') }}" rel="stylesheet">
  </head>
@php
$produk = $data['produk'];
$komentar = $data['komentar_all_detail'];
@endphp
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!--div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            < /menu profile quick info -->

            <!--br /-->

            <!-- sidebar menu -->
            @include('admin.layout.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div-->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
            @include('admin.layout.navbar')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="">
            <div class="row">
              <div class="col-sm-12">
                @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('success') }}  
                </div>
                @endif

                @error('path')
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $message }}  
                </div>
                @enderror

                @error('gambar')
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $message }}  
                </div>
                @enderror

              </div>
            </div>
            <div class="page-title">
              <div class="title_left">
                <h3>Detail {{ $produk->nama_produk }}</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $produk->nama_produk }}</h2>
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

                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="product-image">
                        <img src="{{ asset($produk->gambar) }}" alt="..." />
                        <form method="post" action="{{ url('admin/produk/ikon/update/'.$produk->id_produk) }}" enctype="multipart/form-data">
                        @csrf
                        <label class="btn"> Ganti gambar
                            <input type="file" accept="image/*" name="gambar" style="display: none;" onchange="form.submit()">
                        </label>
                        </form>
                      </div>
                      
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12" style="border:0px solid #e5e5e5;">

                      <h3 class="prod_title">{{ $produk->nama_produk }}</h3>

                      <p>{!! $produk->deskripsi !!}</p>
                      <br />

                      

                      <div class="">
                        <div class="product_price">
                          <h1 class="price">Rp {{ number_format($produk->harga,2,',','.') }}</h1>
                          <br>
                        </div>
                      </div>

                      <div class="">
                        <a href="{{ url('admin/produk/edit/'.$produk->id_produk) }}" class="btn btn-default btn-lg btn-warning">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-default btn-lg btn-danger">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>

                     

                    </div>
                   
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <!--div class="product_gallery">
                        
                        @foreach($data['gambar_produk'] as $gambar)

                          
                          <a>
                          <span class="badge bg-green">211</span>
                          <span class="badge bg-green">211</span>
                          <img src="{{ asset($gambar->path) }}" style="max-height: 100%;" alt="..." />

                          </a>

                        @endforeach
                      </div-->
                      @foreach($data['gambar_produk'] as $gambar)
                       <div class="col-md-55">
                        <div class="image view view-first">
                            <img style="max-height: 100%;width: 100%; display: block;" src="{{ asset($gambar->path) }}" alt="image">
                            <div class="mask">
                                <form method="post" action="{{ url('admin/produk/gambar/update/'.$gambar->id_gambar) }}" enctype="multipart/form-data">
                                  @csrf
                                  <label>
                                    <a class="btn btn-warning btn-lg ">
                                      <i class="fa fa-pencil"></i>
                                      <input type="file" name="path" accept="image/*" style="display: none;" onchange="form.submit()">
                                    </a>
                                  </label>
                                </form>
                                <a href="{{ url('admin/produk/gambar/delete/'.$gambar->id_gambar) }}" class="btn btn-danger btn-lg "><i class="fa fa-times"></i></a>
                              </div>
                          </div>
                    </div>
                    @endforeach
                    <form method="post" action="{{ url('admin/produk/gambar/save/') }}" enctype="multipart/form-data">
                    @csrf
                    <label>
                      <a class="btn btn-app">
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                      <input type="file" accept="image/*" name="path" style="display: none;" onchange="form.submit();">
                      <i class="fa fa-plus"></i> Tambah Gambar
                    </a>
                    </label>
                    </form>
                    </div>



                    <br>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Komentar {{ $produk->nama_produk }}</h2>
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

                    <div class="col-md-12">

                      </hr>
                    <h3>Komentar</h3>


                      <table class="table table-responsive table-stripped">
                        @foreach($komentar as $komentar)
                        <tr>
                          <td><i class="fa fa-users"></i> {{ $komentar->role }}</td>
                          <td><i class="fa fa-user"></i> {{ $komentar->nama }}</td>
                          <td><i class="fa fa-calendar"></i> {{ $komentar->tanggal }}</td>
                        </tr>
                        <tr>
                          <td colspan="3">{{ $komentar->komentar }}</td>
                        </tr>
                        @endforeach
                      </table>

                      <form method="post" action="{{ url('produk/komentar/') }}">
                        @csrf
                        <div class="form-group">
                          <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
                          <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                          <input type="hidden" name="kode_status" value="2">
                          <input type="hidden" name="status" value="dibaca">
                            <textarea class="resizable_textarea form-control" name="komentar"></textarea>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-default" name="kirim"> Balas Komentar </button>
                      </form>
                      {!! $data['komentar_all_detail']->render() !!}

                  </div>


                    
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('gentelella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('gentelella/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('gentelella/vendors/nprogress/nprogress.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('gentelella/build/js/custom.min.js') }}"></script>
  </body>
</html>