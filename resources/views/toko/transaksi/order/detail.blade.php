@extends('toko.layouts.app')
@section('content')
@php 
  $bayar=0;
  $ongkir=0;
  $metode_pengiriman = $data['metode_pengiriman']; 
  $order = $data['order']; 
  $id = $data['id']; 
  $status = $data['status']; 
  $kode_status = $data['kode_status']; 
  $order_histori = $data['order_histori']; 
  $pengiriman = $data['pengiriman']; 
@endphp
<!-- bredcrumb and page title block end  -->
<style type="text/css">
  @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
  <div id="checkout-step-contain">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <h2 class="delivery-method tf">Ringkasan Pesanan</h2>
        </div>
        <div class="col-sm-8 col-xs-12">
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
        
        <div class="col-md-4 col-xs-12"> 
          <!-- right block Start  -->
          <div id="right">
            <div class="sidebar-block">
              <div class="sidebar-widget">
                <div class="sidebar-title">
                  <h4>Udah sampai mana pesananmu?</h4>
                </div>
                <div id="order-detail-content" class="title-toggle table-block">
                  <div class="carttable">
                    <table class="table table-stripped" id="cart-summary">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Riwayat</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($order_histori as $histori)
                        <tr>
                          <td>{{ $histori->created_at }}</td>
                          <td>{{ $histori->status }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- left block end  --> 
        </div>

        <div class="col-xs-8 col-sm-8">
          <div class="cart-bottom">
            <div class="box-footer">
              <div class="pull-left"><a href="{{ url('pelanggan') }}" class="btn btn-default"> <i class="fa fa-arrow-left"></i> &nbsp; Kembali ke Profil </a></div>
              <div class="pull-right">
                @if($kode_status == '1')
                  @if($pengiriman == 0)
                <a class="btn btn-primary btn-small" href="{{ url('pengiriman/'.$id) }}" ><i class="fa fa-arrow-right"></i> Ke Pengiriman </a>  
                  @else
                <form method="post" action="{{ url('order/konfirmasi/kirim/'.$id) }}">
                  @csrf
                  <input type="hidden" name="id_order" value="{{ $id }}">
                  <input type="hidden" name="kode_status" value="2">
                  <input type="hidden" name="status" value="memesan">
                <button class="btn btn-primary btn-small " type="submit"> Konfirmasi Order &nbsp; <i class="fa fa-check"></i> </button>
                </form>
                  @endif
                @elseif($kode_status == '2' || $kode_status == '4')
                <a class="btn btn-primary btn-small" href="{{ url('pembayaran/konfirmasi/'.$id) }}" > <i class="fa fa-check"></i> Konfirmasi Pembayaran </a> 
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
