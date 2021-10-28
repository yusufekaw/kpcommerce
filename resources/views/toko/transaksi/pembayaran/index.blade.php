@extends('toko.layouts.app')
@section('content')
@php 
	$bayar=0;
  $ongkir=0;
  $id=$data['id'];
  $order=$data['order'];
  $metode_pengiriman=$data['metode_pengiriman'];
	$bank=$data['bank'];
@endphp

<!-- Main menu End --> 
  
  <!-- offer block Start  -->
  <div id="offer">
  	<div class="container">
  		<div class="alert alert-info" role="alert">
  			<h3 align="center">
  				Pesanan kamu udah kami terima. <br> <small>Langsung bayar ya! biar bisa segera kami proses.</small>	
  			</h3>
  			
  		</div>
  	</div>
  </div>
  <!-- offer block end  -->
  <!-- bredcrumb and page title block end  -->
 
  <div id="cart-page-contain">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xs-12"> 
            <!-- left block Start  -->
            <div class="cart-content table-responsive">
            <table class="cart-table ">
              <tbody>
                <tr class="Cartproduct carttableheader">
                  <td style="width:10%">Product</td>
                  <td style="width:45%">Deskripsi</td>
                  <td style="width:10%">QNT</td>
                  <td style="width:15%">Total</td>
                </tr>

                @foreach($order as $order)
                @php
                  $nama_produk = $order->nama_produk;
                  $nama_produk = str_replace(' ','_',$nama_produk);
                @endphp
                <tr class="Cartproduct">
                  <td>
                  	<div class="image">
                  		<a href="{{ url('produk/'.$order->id_produk.'/nama/'.$nama_produk) }}"><img alt="img" src="{{ url($order->gambar) }}"></a>
                  	</div>
                  </td>
                  <td>
                  	<div class="product-name">
                      <h3><a href="{{ url('produk/'.$order->id_produk.'/nama/'.$nama_produk) }}">{{ $order->nama_produk }}</a></h3>
                    </div>
                    <div class="price">
                    	<span>Rp. {{ number_format($order->harga,2,',','.') }}</span>
                    </div>
                    <div class="product-name">
                      <p><a href="product-detail-view.html">{{ $order->catatan }}</a></p>
                    </div>
                </td>
                  <td class="product-quantity"><div class="quantity">
                      {{ $order->qty }}
                    </div></td>
                  <td class="price">Rp. {{ number_format($order->total_harga,2,',','.') }}</td>
                </tr>
                @php 
                	$bayar+=$order->total_harga
                @endphp
                @endforeach
                <tr class="cart-detail">
                  <td colspan="3">Total produk</td>
                  <td colspan="2" class="price">Rp. {{  number_format($bayar,2,',','.') }}</td>
                </tr>
                <tr class="cart-detail">
                  <td colspan="3">Ongkir</td>
                  @foreach($metode_pengiriman as $metode_pengiriman)
                  <td colspan="2" class="price"><span class="success">Rp. {{ number_format( $metode_pengiriman->tarif,2,',','.') }}</span></td>
                  @php
                  	$ongkir+=$metode_pengiriman->tarif;
                  @endphp
                  @endforeach
                </tr>
                <tr class="cart-detail">
                  <td colspan="3"> Total</td>
                  <td colspan="2" class="price" id="total-price">Rp. {{ number_format($bayar+$ongkir,2,',','.') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          &nbsp;
            <div class="cart-bottom">
              <div class="box-footer">
                <div class="alert alert-success" role="alert">
                	<h5 align="center">Udah bayar? 
                		<small>jangan lupa konfirmasi biar kami tahu kalo kamu udah bayar.</small>
                	</h5>
                </div>
              </div>
            </div>
            <!-- left block end  --> 
          </div>
          <div class="col-md-4 col-xs-12"> 
            <!-- right block Start  -->
            <div id="right">
              <div class="sidebar-block">
                <div class="sidebar-widget">
                  <div class="sidebar-title">
                    <h4>Kami Menerima Pembayaran</h4>
                  </div>
                  <div id="order-detail-content" class="title-toggle table-block">
                    <div class="carttable">
                      <table class="table table-stripped" id="cart-summary">
                        <tbody>
                          @foreach($bank as $bank)
                          <tr>
                            <td style="width:30%" > <img src="{{ url($bank->logo) }}"> &nbsp; </td>
                            <td style="width:70%">
                              &nbsp;{{ $bank->nama_bank}}&nbsp;{{ $bank->rekening}}<br>&nbsp;{{ $bank->atas_nama }}
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="checkout"> <a href="{{ url('pembayaran/konfirmasi/'.$id) }}" title="checkout" class="btn btn-default ">Konfirmasi Pembayaran</a> </div>
              </div>
            </div>
            <!-- left block end  --> 
          </div>
        </div>
      </div>
    </div>
   &nbsp; 
@endsection