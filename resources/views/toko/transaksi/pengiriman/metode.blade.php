@extends('toko.layouts.app')
@section('content')
@php
  $jne = $data['jne'];
  $tiki = $data['tiki'];
  $pos = $data['pos'];
  $id_order = $data['id_order'];
  $weight = $data['weight'];
  $id_pengiriman = $data['id_pengiriman'];
  error_reporting(0);
@endphp
<div class="wrapar"> 
  <div id="checkout-step-contain">
    <div class="container">
      <div class="account-content checkout-staps">
        
          
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                  	<tr>
                  		<th colspan="4"> JNE </th>
                  	</tr>
                    <tr>
                      <th>Jenis Layanan</th>
                      <th>Estimasi Pengiriman</th>
                      <th>Total Harga</th>
                      <th>Aksi</th>
                    </tr>
                    @for($i=0; $i < count($jne[0]['costs']); $i++)
                    @php 
                    $layanan = $jne[0]['costs'][$i]['service'];
                    $deskripsi = $jne[0]['costs'][$i]['description'];
                    $estimasi = $jne[0]['costs'][$i]['cost'][0]['etd'];
                    $tarif = $jne[0]['costs'][$i]['cost'][0]['value'];
                    @endphp
                    <form method="post" action="{{ url('pengiriman/metode/simpan') }}">
                    	@csrf
                      <input type="hidden" name="kurir" value="jne">
                    	<input type="hidden" name="id_order" value="{{ $id_order }}">
                    	<input type="hidden" name="layanan" value="{{ $layanan }}">
                    	<input type="hidden" name="tarif" value="{{ $tarif }}">
                    	<input type="hidden" name="berat" value="{{ $weight }}">
                    	<input type="hidden" name="id_pengiriman" value="{{ $id_pengiriman }}">
                    	<tr>
                    		<td>{{ $layanan }}<br>{{ $deskripsi }}</td>
                    		<td>{{ $estimasi }}</td>
                    		<td>Rp. {{ number_format($tarif,2,',','.') }}</td>
                    		<td><input type="submit" name="kirim" value="kirim"></td>
                    	</tr>
                    </form>

                    @endfor
                    
                  </tbody>
                </table>
              </div>

               <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                  	<tr>
                  		<th colspan="4"> POS </th>
                  	</tr>
                    <tr>
                      <th>Jenis Layanan</th>
                      <th>Estimasi Pengiriman</th>
                      <th>Total Harga</th>
                      <th>Aksi</th>
                    </tr>
                    @for($i=0; $i < count($pos[0]['costs']); $i++)
                    @php 
                    $layanan = $pos[0]['costs'][$i]['service'];
                    $deskripsi = $pos[0]['costs'][$i]['description'];
                    $estimasi = $pos[0]['costs'][$i]['cost'][0]['etd'];
                    $tarif = $pos[0]['costs'][$i]['cost'][0]['value'];
                    @endphp
                    <form method="post" action="{{ url('pengiriman/metode/simpan') }}">
                    	@csrf
                    	<input type="hidden" name="kurir" value="post">
                      <input type="hidden" name="id_order" value="{{ $id_order }}">
                    	<input type="hidden" name="layanan" value="{{ $layanan }}">
                    	<input type="hidden" name="tarif" value="{{ $tarif }}">
                    	<input type="hidden" name="berat" value="{{ $weight }}">
                    	<input type="hidden" name="id_pengiriman" value="{{ $id_pengiriman }}">
                    	<tr>
                    		<td>{{ $layanan }}<br>{{ $deskripsi }}</td>
                    		<td>{{ $estimasi }}</td>
                    		<td>Rp. {{ number_format($tarif,2,',','.') }}</td>
                    		<td><input type="submit" name="kirim" value="kirim"></td>
                    	</tr>
                    </form>

                    @endfor
                    
                  </tbody>
                </table>
              </div>

            @if(count($tiki[0]['costs'])>0)
			       <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                  	<tr>
                  		<th colspan="4"> TIKI </th>
                  	</tr>
                    <tr>
                      <th>Jenis Layanan</th>
                      <th>Estimasi Pengiriman</th>
                      <th>Total Harga</th>
                      <th>Aksi</th>
                    </tr>
                    @for($i=0; $i < count($tiki[0]['costs']); $i++)
                    @if($i==0)
                    <tr>
                      <td colspan=4>
                        Saat ini tiki gak bisa ngirim ke alamatmu
                      </td>
                    </tr>
                    @endif
                    @php 
                    $layanan = $tiki[0]['costs'][$i]['service'];
                    $deskripsi = $tiki[0]['costs'][$i]['description'];
                    $estimasi = $tiki[0]['costs'][$i]['cost'][0]['etd'];
                    $tarif = $tiki[0]['costs'][$i]['cost'][0]['value'];
                    @endphp
                    <form method="post" action="{{ url('pengiriman/metode/simpan') }}">
                    	@csrf
                    	<input type="hidden" name="kurir" value="tiki">
                      <input type="hidden" name="id_order" value="{{ $id_order }}">
                    	<input type="hidden" name="layanan" value="{{ $layanan }}">
                    	<input type="hidden" name="tarif" value="{{ $tarif }}">
                    	<input type="hidden" name="berat" value="{{ $weight }}">
                    	<input type="hidden" name="id_pengiriman" value="{{ $id_pengiriman }}">
                    	<tr>
                    		<td>{{ $layanan }}<br>{{ $deskripsi }}</td>
                    		<td>{{ $estimasi }}</td>
                    		<td>{{ number_format($tarif,2,',','.') }}</td>
                    		<td><input type="submit" name="kirim" value="kirim"></td>
                    	</tr>
                    </form>

                    @endfor
                  </tbody>
                </table>
              </div>
              @endif

          </div>
      </div>
    </div>
  </div>


@endsection