  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->nama_depan." ".Auth::user()->nama_belakang }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> <span>Dashbooard</span></a></li>
        @if(Auth::user()->role=='superadmin')
        <li><a href="{{ url('admin/useradmin') }}"><i class="fa fa-user"></i> <span>User Admin</span></a></li>
        @endif
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tags"></i> <span>Katalog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('admin/kategori') }}"><i class="fa fa-folder"></i> Kategori</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-archive"></i> Produk
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/produk') }}"><i class="fa fa-search"></i> Semua Produk</a></li>
                <li><a href="{{ url('admin/produk/add') }}"><i class="fa fa-plus"></i> Tambah Produk</a></li>
              </ul>
            </li>
          </ul>
        </li>

        
        <li><a href="{{ url('admin/bank') }}"><i class="fa fa-bank"></i> <span>Bank</span></a></li>
        
      </ul>

       
    </section>
    <!-- /.sidebar -->
  </aside>