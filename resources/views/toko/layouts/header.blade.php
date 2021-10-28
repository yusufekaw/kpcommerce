@php 
  $total=0;
  $keranjang = $data['keranjang'] ;
  $toko = $data['toko'] ;
@endphp

<!-- Header Start-->
<div class="header">
  <div class="header-top">
    <div class="container">
      <div class="call pull-left">
        <p>|&nbsp;
        @foreach($data['kontak'] as $kontak)
            @if($kontak->urutan > 1 && $kontak->urutan < 6 )
              <span> <i class="fa {{ $kontak->ikon }}"></i> {{ $kontak->kontak_info }}</span> &nbsp;|&nbsp; 
             @endif
        @endforeach 
        </p>
      </div>
      <div class="user-info pull-right">
        <div class="user">
          <ul>
            @guest
            <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
            <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>
            @else
            <li ><a href="{{ url('pelanggan') }}">{{ Auth::user()->nama_depan." ".Auth::user()->nama_belakang }}</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="header-mid">
  <div class="container">
    <div class="row">
      <div class="col-md-3 header-left">
        <div class="logo"> <a href="{{ url('/') }}"><img src="{{ asset($toko->logo) }}" alt="#" width="90px"></a> </div>
      </div>
      <div class="col-md-6 search_block">
        <div class="search">
          <form method="post" action="{{ url('/produk/cari') }}">
            @csrf
            <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Cari produk yang kamu mau, barangkali ada">
            <button type="submit" class="btn submit"> <span class="fa fa-search"></span></button>
          </form>
        </div>
      </div>
      @if(Auth::user())
      <form method="post" action="{{ url('checkout') }}">
        @csrf
      <div class="col-md-3 header-right">
        <div class="cart">
          <div class="cart-icon dropdown"></div>
          <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="{{ url('keranjang') }}">Keranjang Belanja</a>
          <ul class="dropdown-menu pull-right cart-dropdown-menu">
            @if($keranjang->count()==0)
            <li>
              <div class="controls col-sm-12">
                <strong class="text text-center text-danger">Keranjang belanja masih kosong</strong>
                <hr>
                <p>Belanja yuk!</p> 
              </div> 
            </li>
            @else
            <li>
              <table class="table table-striped">
                <tbody>

                  @foreach($keranjang as $keranjang)
                  @php
                    $nama_produk = $keranjang->nama_produk;
                    $nama_produk = str_replace(' ','_',$nama_produk);
                  @endphp
                  <tr>
                    <td class="text-center">
                      <a href="{{ url('produk/'.$keranjang->id_produk.'/nama/'.$nama_produk) }}">
                        <img class="img-thumbnail" width="50" src="{{ asset($keranjang->gambar) }}" alt="img">
                      </a>
                    </td>
                    <td class="text-left">
                      <a href="{{ url('produk/'.$keranjang->id_produk.'/nama/'.$nama_produk) }}">{{ $keranjang->nama_produk }}</a>
                    </td>
                    <td class="text-right quality">{{ $keranjang->qty }}</td>
                    <td class="text-right price-new">Rp. {{number_format($keranjang->total_harga,2,',','.') }}</td>
                    <td class="text-center">
                    <a class="btn btn-xs remove" href="{{ url('keranjang/hapus/'.$keranjang->id_keranjang) }}">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                    @php $total+=$keranjang->total_harga @endphp
                  </tr>
                    <input type="hidden" name="id_keranjang[]" value="{{ $keranjang->id_keranjang }}">
                    <input type="hidden" name="id_produk[]" value="{{ $keranjang->id_produk }}">
                    <input type="hidden" name="id_user[]" value="{{ $keranjang->id_user }}">
                    <input type="hidden" name="total_harga[]" value="{{ $keranjang->total_harga }}">
                    <input type="hidden" name="harga[]" value="{{ $keranjang->harga }}">
                    <input type="hidden" name="berat_total[]" value="{{ $keranjang->berat_total }}">
                    <input type="hidden" name="berat[]" value="{{ $keranjang->berat }}">
                    <input type="hidden" name="qty[]" value="{{ $keranjang->qty }}">
                    <input type="hidden" name="catatan[]" value="{{ $keranjang->catatan }}">
                      
                  @endforeach
                </tbody>
              </table>
            </li>
            <li>
              <div class="minitotal">
                <table class="table pricetotal">
                  <tbody>
                    <tr>
                      <td class="text-right"><strong>Total</strong></td>
                      <td class="text-right price-new">Rp. {{number_format($total,2,',','.') }}</td>
                    </tr>
                  </tbody>
                </table>
                <div class="controls col-sm-12"> 
                  <a class="btn btn-primary pull-left" href="{{ url('keranjang') }}" id="view-cart">
                    <i class="fa fa-shopping-cart"></i> Keranjang Saya 
                  </a>
                 
                  <button type="submit" class="btn btn-primary pull-right" id="checkout">
                    <i class="fa fa-share"></i> Checkout </button> 

                  </div>
                </div>
              </li>
              @endif
            </ul>
          </div>
        </div>
        </form>
        @endif
      </div>
    </div>
  </div>
  
</div>
<!-- Header End --> 

<!-- Modal -->
<div class="modal fade" id="login" role="dialog">
  <div class="modal-dialog modal-danger"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <div class="panel-heading">
          <div class="panel-title pull-left">Login</div>
          <div class="pull-right">
            <button aria-hidden="true" data-dismiss="modal" class="close btn btn-xs " type="button"> <i class="fa fa-times"></i> </button>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form id="loginform" class="form-horizontal" method="post" action="{{ url('login') }}">
          @csrf
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="email"  value="{{ old('email') }}">
          </div>
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
          </div>
          <div class="input-group">
            <div class="checkbox">
              <label>
                <input id="login-remember" type="checkbox" name="remember" value="1">
              Remember me</label>
            </div>
          </div>
          <div class="form-group"> 
            <!-- Button -->
            <div class="col-sm-12 controls col-sm-8"> 
              <button type="submit" id="btn-login" href="#" class="btn btn-primary btn-success">Login</button> 
              <a href="{{ route('password.request') }}"> Lupa Password? </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="register" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <div class="panel-heading">
          <div class="panel-title pull-left">Register</div>
          <div class="pull-right">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i> </button>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('pelanggan/save') }}">
          @csrf
          <input type="hidden" name="id_user" value="{{ 'c'.crc32(Date('ymdhis')) }}">
          <div class="row">
            <div class="control-group col-md-12"> 
              <label class="control-label col-sm-4"  for="nama_depan">Nama Depan</label>
              <div class="controls col-sm-8">
                <input type="text" id="nama_depan" name="nama_depan" placeholder="Nama Depan" class="input-xlarge" required="required" value="{{ old('nama_depan') }}">
                @error('nama_depan')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="control-group col-md-12"> 
              <label class="control-label col-sm-4"  for="nama_belakang">Nama Belakang</label>
              <div class="controls col-sm-8">
                <input type="text" id="nama_belakang" name="nama_belakang" placeholder="Nama Belakang" class="input-xlarge" required="required" value="{{ old('nama_belakang') }}">
                @error('nama_belakang')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <input type="hidden" name="role" value="pelanggan">
            <div class="control-group col-md-12"> 
              <label class="control-label col-sm-4"  for="nama_belakang">Jenis Kelamin</label>
              <div class="controls col-sm-8">
                <label class="radio-inline">
                  <input type="radio" name="gender" value="l" required="required">Laki-Laki
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="p" required="required">Perempuan
                </label>

              </div>
            </div>
            <div class="control-group col-md-12"> 
              <!-- E-mail -->
              <label class="control-label col-sm-4" for="email">E-mail</label>
              <div class="controls col-sm-8">
                <input type="email" id="email" name="email" placeholder="email" class="input-xlarge" required="required" value="{{ old('email') }}">

              </div>
            </div>
            <div class="control-group col-md-12"> 
              <!-- Password-->
              <label class="control-label col-sm-4" for="password">Password</label>
              <div class="controls col-sm-8">
                <input id="password" type="password" class="input-xlarge @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

              </div>
            </div>
            <div class="control-group col-md-12"> 
              <!-- Password -->
              <label class="control-label col-sm-4"  for="password_confirm">Konfirmasi Password</label>
              <div class="controls col-sm-8">
                <input id="password-confirm" type="password" class="input-xlarge" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>
            <div class="control-group col-md-12"> 
              <!-- Button -->
              <div class="controls col-sm-8">
                <button class="btn btn-success">Register</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

