@extends('toko.layouts.app')
@section('content')
@php
	$produk = $data['produk'];
@endphp 

 <!-- offer block Start  -->
@include('toko.layouts.alert')

  <!-- offer block end  --> 
<div id="product-category">
  <div class="container">
    

    <div class="row">
      <!-- left block Start  -->
      @include('toko.layouts.sidemenu')          
      <!-- left block end  --> 
      <form method="post" action="{{ url('produk/sort') }}">
        @csrf
        <div class="shoring pull-right">
          <div class="short-by">
            <p>Sort By</p>
            <div class="select-item">
              <select name="sort">
                <option> -- Produk Terbaru -- </option>
                <option onclick="form.submit()" value="nama_produk asc">Nama (A to Z)</option>
                <option onclick="form.submit()" value="nama_produk desc">Nama (Z - A)</option>
                <option onclick="form.submit()" value="harga asc">Harga (low&gt;high)</option>
                <option onclick="form.submit()" value="harga desc">Harga(high &gt; low)</option>
              </select>
              <span class="fa fa-angle-down"></span> </div>
            </div>
          </div>
        </form>
      <div class="col-md-9 col-sm-8"> 

        <!-- right block Start  -->
        <div id="right">
          
              <div class="product-grid-view">
                <ul>
                  @foreach($produk as $produk)
                  @php
                    $nama_produk = $produk->nama_produk;
                    $nama_produk = str_replace(' ','_',$nama_produk)
                  @endphp
                  @if($produk->stok-$produk->qty > 0)
                  <li>
                    <div class="item col-md-4 col-sm-6 col-xs-6">
                      <div class="product-block ">
                        <div class="image"> <a href="{{ url('produk/'.$produk->id_produk.'/nama/'.$nama_produk) }}"><img class="img-responsive" title="T-shirt" alt="T-shirt" src="{{ asset($produk->gambar) }}"></a> </div>
                        <div class="product-details">
                          <div class="product-name">
                            <h4><a href="{{ url('produk/'.$produk->id_produk.'/nama/'.$nama_produk) }}">{{ $produk->nama_produk }} </a></h4>
                          </div>
                          <div class="price"> Rp. {{ number_format($produk->harga,2,',','.') }} </div>
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
                            <div class="review"> <span class="rate"><strong> masih ada {{ $produk->stok-$produk->qty }} barang </strong>  </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endif
                    @endforeach

                  </ul>
                </div>
              </div>

        
            {!! $data['produk']->render() !!}
        <!-- right block end  --> 
      </div>
    </div>
  </div>
</div>
@endsection