@extends('toko.layouts.app')
@section('content')
@php 
	$bayar=0;
	$ongkir=0;
  $metode_pengiriman = $data['metode_pengiriman']; 
  $order = $data['order']; 
  $id = $data['id']; 
@endphp
<!-- bredcrumb and page title block end  -->
  <div id="checkout-step-contain">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <h2 class="delivery-method tf">Order Riview</h2>
        </div>
        <div class="col-md-12">
          <div class="cart-content table-responsive">
            <table class="cart-table ">
              <tbody>
                <tr class="Cartproduct carttableheader">
                  <td style="width:10%"> Product</td>
                  <td style="width:45%">Details</td>
                  <td style="width:10%">QNT</td>
                  <td style="width:15%">Total</td>
                </tr>

                @foreach($order as $order)
                @php
                  $nama_produk = $order->nama_produk;
                  $nama_produk = str_replace(' ','_',$nama_produk);
                @endphp
                <tr class="Cartproduct">
                  <td ><div class="image"><a href="{{ url('produk/'.$order->id_produk.'/nama/'.$nama_produk) }}"><img alt="img" src="{{ url($order->gambar) }}"></a></div></td>
                  <td><div class="product-name">
                      <h3><a href="{{ url('produk/'.$order->id_produk.'/nama/'.$nama_produk) }}">{{ $order->nama_produk }}</a></h3>
                    </div>
                    <div class="price"><span>Rp. {{ number_format($order->harga,2,',','.') }}</span></div></td>
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
        </div>
        <div class="col-xs-12 col-sm-12">
          <div class="cart-bottom">
            <div class="box-footer">
              <div class="pull-left"><a href="{{ url('/') }}" class="btn btn-default"> <i class="fa fa-arrow-left"></i> &nbsp; Belanja lagi </a></div>
              <div class="pull-right">
              	<form method="post" action="{{ url('order/konfirmasi/kirim/'.$id) }}">
              		@csrf
              		<input type="hidden" name="id_order" value="{{ $id }}">
                  <input type="hidden" name="status" value="memesan">
              		<input type="hidden" name="kode_status" value=2>
              	<button class="btn btn-primary btn-small " type="submit"> Konfirmasi Order &nbsp; <i class="fa fa-check"></i> </button>
              	</form> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
