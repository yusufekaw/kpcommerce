@extends('toko.layouts.app')
@section('content')

<div id="product-category">
  <div class="container">
    <div class="row">
      <!-- left block Start  -->
      @include('toko.layouts.sidemenu')          
      <!-- left block end  --> 
      <div class="col-md-9 col-sm-8"> 
        <!-- right block Start  -->
        <div id="right">
          
              <div class="product-grid-view">
                <ul>
                  @foreach($produk_all as $produk)
                  <li>
                    <div class="item col-md-4 col-sm-6 col-xs-6">
                      <div class="product-block ">
                        <div class="image"> <a href="{{ url('produk/'.$produk->id_produk) }}"><img class="img-responsive" title="T-shirt" alt="T-shirt" src="{{ asset($produk->gambar) }}"></a> </div>
                        <div class="product-details">
                          <div class="product-name">
                            <h4><a href="product-detail-view.html">{{ $produk->nama_produk }} </a></h4>
                          </div>
                          <div class="price"> Rp.  {{ $produk->harga }} </div>
                          <div class="product-hov">
                            @if(Auth::user())
                            <ul>
                              <li class="addtocart"><a href="{{ url('keranjang/beli/'.$produk->id_produk) }}">Masukin Keranjang</a> </li>
                            </ul>
                            @else
                            <ul>
                              <li class="addtocart">Mau beli? Login dulu!</li>
                            </ul>
                            @endif
                            <div class="review"> <span class="rate"><strong> masih ada {{ $produk->stok }} barang </strong>  </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endforeach

                  </ul>
                </div>
              </div>
          <!--
          <div class="row">
            <div class="pagination-bar">
              <ul>
                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
              </ul>
            </div>
          </div>
        -->
        <div class="row">
          <div class="pagination-bar">
            <ul>
              <li>{{ $produk_all->render() }}</li>
            </ul>
          </div>
        </div>
        <!-- right block end  --> 
      </div>
    </div>
  </div>
</div>
@endsection