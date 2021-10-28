@extends('toko.layouts.app')
@section('content')
@php
$keranjang = $data['keranjang']
@endphp

<!-- offer block Start  -->
  <div id="offer">
    <div class="container">
      <div class="offer">
        <p>Mumpung masih di keranjang belanja, kamu bisa balikin barang-barang yang gak jadi kamu beli. Karena kalau udah checkout, barang yang udah kamu beli gak bisa dibalikin lagi!</p>
      </div>
    </div>
  </div>
  <!-- offer block end  --> 
  &nbsp;
  @include('toko.layouts.alert')

<!-- bredcrumb and page title block start  -->
  <div id="bread-crumb">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3">
          <div class="page-title">
            <h4>Keranjang Belanja</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- bredcrumb and page title block end  -->


  <form method="post">
    @csrf
  <div id="cart-page-contain">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-xs-12"> 
          <!-- left block Start  -->
          <div class="cart-content table-responsive">
            <table class="cart-table table-responsive" style="width:100%">
              <tbody>
                <tr class="Cartproduct carttableheader">
                  <td style="width:15%"> Product</td>
                  <td style="width:45%">Details</td>
                  <td style="width:10%">QNT</td>
                  <td style="width:15%">Total</td>
                  <td class="delete" style="width:10%">&nbsp;</td>
                </tr>
                @php 
                  $total_harga = 0; 
                  $berat_total = 0;
                @endphp
                @foreach($keranjang as $keranjangs)
                @php
                  $nama_produk = $keranjangs->nama_produk;
                  $nama_produk = str_replace(' ','_',$nama_produk);
                @endphp
                <input type="hidden" name="id_keranjang[]" value="{{ $keranjangs->id_keranjang }}">
                <input type="hidden" name="id_produk[]" value="{{ $keranjangs->id_produk }}">
                <input type="hidden" name="id_user[]" value="{{ $keranjangs->id_user }}">
                <input type="hidden" name="total_harga[]" value="{{ $keranjangs->total_harga }}">
                <input type="hidden" name="harga[]" value="{{ $keranjangs->harga }}">
                <input type="hidden" name="berat_total[]" value="{{ $keranjangs->berat_total }}">
                <input type="hidden" name="berat[]" value="{{ $keranjangs->berat }}">
                @php
                @endphp
                <tr class="Cartproduct">
                 	<td>
                  		<div class="image">
                  			<a href="{{ url('produk/'.$keranjangs->id_produk.'/nama/'.$nama_produk) }}">
                  				<img alt="img" src="{{ $keranjangs->gambar }}">
                  			</a>
                  		</div>
                  	</td>
                  	<td>
                  	<div class="product-name">
                      	<h4><a href="{{ url('produk/'.$keranjangs->id_produk.'/nama/'.$nama_produk) }}">{{ $keranjangs->nama_produk }} </a></h4>
                    </div>
                    <div class="price"><span>Rp. {{number_format($keranjangs->harga,2,',','.') }}</span></div>
                	</td>
                  	<td class="product-quantity">
                  		<div class="quantity">
                    	<input type="number" size="4" class="input-text qty text" title="Qty" value="{{ $keranjangs->qty }}" name="qty[]" min="1" max="{{ $keranjangs->stok }}" step="1">
                    	</div>
                    </td>
                  	<td class="price">Rp. {{ number_format($keranjangs->total_harga,2,',','.') }}</td>
                  	<td class="delete">
                      <input type="hidden" name="id_delete" value="{{ $keranjangs->id_keranjang }}">
                      <input type="hidden" name="url" value="{{ Request::url() }}">
                      <a href="{{ url('keranjang/hapus/'.$keranjangs->id_keranjang) }}" title="Delete"> <i class="glyphicon glyphicon-trash "></i></a>
                    </td>
                    @php 
                      $total_harga+=$keranjangs->total_harga; 
                      $berat_total+=$keranjangs->berat_total; 
                    @endphp
                </tr>
                <tr class="Cartproduct">
                  <td></td>
                  <th>Catatan Pembelian</th>
                  <td colspan="4"> <textarea class="form-control"  name="catatan[]">{{ $keranjangs->catatan }}</textarea> </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
          <div class="cart-bottom">
            <div class="box-footer">
              <div class="pull-left"><a class="btn btn-default" href="{{ url('/') }}"> <i class="fa fa-arrow-left"></i> &nbsp; Belanja lgi </a></div>
              <div class="pull-right">
                <button class="btn btn-default" type="submit" formaction="{{ url('keranjang/update') }}"><i class="fa fa-undo"></i> &nbsp; Perbarui Keranjang</button>
              </div>
            </div>
          </div>
          <!-- left block end  --> 
        </div>
        <div class="col-md-3 col-xs-12"> 
          <!-- right block Start  -->
          <div id="right">
            <div class="sidebar-block">
              <div class="sidebar-widget">
                <div class="sidebar-title">
                  <h4>Ringkasan Belanja</h4>
                </div>
                <div id="order-detail-content" class="title-toggle table-block">
                  <div class="carttable">
                    <table class="table" id="cart-summary">
                      <tbody>
                        <tr>
                          <td>Total pembelian</td>
                          <td class="price">Rp. {{ number_format($total_harga,2,',','.') }}</td>
                        </tr>
                        <tr>
                          <td>Berat Total</td>
                          <td class="price">{{ $berat_total }} gram</td>
                        </tr>
                        <tr>
                          <td>Ongkos kirim</td>
                          <td class="price"><span class="success">Rp. 0,00 (Belum ditetapkan)</span></td>
                        </tr>
                        <tr>
                          <td> Total Bayar</td>
                          <td id="total-price">Rp. {{ number_format($total_harga,2,',','.') }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="checkout"> <button type="submit" formaction="{{ url('checkout') }}" title="checkout" class="btn btn-default ">Proses ke Chekout</button> </div>
            </div>
          </div>
          <!-- left block end  --> 
        </div>
      </div>
    </div>
  </div>
</form>
  &nbsp
@endsection