<!-- top navigation -->
@php
  $order = $data['order'];
  $komentar = $data['komentar_all'];
  $order_count = $data['order_count'];
  $koment_count = $data['komentar_count'];
@endphp
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset(Auth::user()->avatar) }}" alt="">{{ Auth::user()->nama_depan.' '.Auth::user()->nama_belakang }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{ url('admin/useradmin/login/profil') }}">Profil<i class="fa fa-user pull-right"></i></a></li>
            <li><a href="{{ url('admin/useradmin/login/edit') }}">Edit Profil<i class="fa fa-pencil pull-right"></i></a></li>
            <li><a href="{{ url('admin/useradmin/login/password/edit') }}">Ganti Password<i class="fa fa-edit pull-right"></i></a></li>
            <li><a href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-shopping-cart"></i>
            <span class="badge bg-green">{{ $order_count }}</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <div class="text-center">
               <a>
                <strong>Ada {{ $order_count }} order yang harus segera dilayani</strong>
                 <i class="fa fa-angle-right"></i>
               </a>
             </div>
            </li>
            @foreach($order as $order)
            <li>
              <a href="{{ url('admin/order/detail/'.$order->id_order) }}">
                <span class="image"><img src="{!! asset($order->avatar) !!}" alt="Profile Image" /></span>
                <span>
                  <span>{{ $order->nama_depan.' '.$order->nama_belakang }}</span>
                  <span class="time"></span>
                </span>
                <span class="message">
                  ID order : {{ $order->id_order }}
                </span>
              </a>
            </li>
            @endforeach
            <li>
             <div class="text-center">
               <a>
                <strong>Lihat Semua Order</strong>
                 <i class="fa fa-angle-right"></i>
               </a>
             </div>
           </li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-comments"></i>
            <span class="badge bg-green">{{ $koment_count }}</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            @foreach($komentar as $komentar)
            <li>
              <a href="{{ url('admin/produk/detail/'.$komentar->id_produk) }}">
                <span class="image"><img src="{{ asset($komentar->avatar) }}" alt="Profile Image" /></span>
                <span class="image"><img src="{{ asset($komentar->gambar) }}" alt="Profile Image" /></span>
                <span>
                  <span>{{ $komentar->nama }} -> {{ $komentar->produk }}</span>
                  <span class="time"></span>
                </span>
                <span class="message">
                  {{ $komentar->komentar }}
                </span>
              </a>
            </li>
            @endforeach
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</div>
        <!-- /top navigation -->