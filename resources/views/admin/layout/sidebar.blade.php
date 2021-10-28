<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>CV Benson</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <form method="post" action="{{ url('admin/useradmin/login/avatar/update/'.Auth::user()->id_user) }}" enctype="multipart/form-data">
          @csrf
        <label>
        <img src="{{ asset(Auth::user()->avatar) }}" alt="..." class="img-circle profile_img">
        <input type="file" name="avatar" style="visibility: hidden;" onchange="form.submit();">
        </label>
        </form>
      </div>
      <div class="profile_info">
        <span>Selamat Datang!</span>
        <h2>{{ Auth::user()->nama_depan.' '.Auth::user()->nama_belakang }}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
          <li><a href="{{ url('admin') }}"><i class="fa fa-home"></i>Beranda</a></li>
          <li><a href="{{ url('admin/toko/pengaturan') }}"><i class="fa fa-gear"></i>Pengaturan Toko</a></li>
          @if(Auth::user()->role=='superadmin')
          <li><a><i class="fa fa-users"></i> User Admin <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ url('admin/useradmin') }}">Semua User</a></li>
              <li><a href="{{ url('admin/useradmin/add') }}">Tambah User</a></li>
            </ul>
          </li>
          @endif
          <li><a href="{{ url('admin/pelanggan') }}"><i class="fa fa-user"></i>Pelanggan</a></li>
          <li><a><i class="fa fa-book"></i> Katalog <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ url('admin/kategori') }}">Kategori</a>
                <li><a>Produk<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li class="sub_menu"><a href="{{ url('admin/produk') }}">Semua Produk</a>
                    </li>
                    <li><a href="{{ url('admin/produk/add') }}">Tambah Produk</a>
                    </li>
                  </ul>
                </li>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-file-text-o"></i> Halaman <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ url('admin/halaman') }}">Semua Halaman</a></li>
              <li><a href="{{ url('admin/halaman/add') }}">Tambah Halaman</a></li>
            </ul>
          </li>
          <li><a href="{{ url('admin/bank') }}"><i class="fa fa-bank"></i>Bank</a></li>
          <li><a href="{{ url('admin/order') }}"><i class="fa fa-shopping-cart"></i>Order</a></li>
          <li><a href="{{ url('admin/penjualan') }}"><i class="fa fa-line-chart"></i>Penjualan</a></li>
          

         
        </ul>
      </div>
      

      </div>
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