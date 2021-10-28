@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')
@php
$total_harga = 0;
@endphp
<h1>hi {{ $nama }}</h1>
<p>Terimakasih udah belanja di CV BENSON</p>
<p>Berikut ini adalah daftar pesanan kamu dengan ID {{ $id_order }} :</p>
<table>
	<tr>
		<th>Produk</th>
		<th>Harga</th>
		<th>Kuantiti</th>
		<th>Total</th>
	</tr>
	@foreach($order_item as $item)
	<tr>
		<td>&nbsp;&nbsp;{{ $item->nama_produk }}</td>
		<td>&nbsp;&nbsp;Rp. {{ number_format($item->harga,2,',','.') }}</td>
		<td>&nbsp;&nbsp;{{ $item->qty }}</td>
		<td>&nbsp;&nbsp;Rp. {{ number_format($item->total_harga,2,',','.') }}</td>
	</tr>
	@php $total_harga+=$item->total_harga @endphp
	@endforeach
	<tr>
		<td colspan="3">&nbsp;&nbsp; Total Harga Produk</td>
		<td>&nbsp;&nbsp;Rp. {{ $total_harga }}</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;&nbsp; Metode Pengriman</td>
		<td>&nbsp;&nbsp; {{ $metode_kirim->kurir.' '.$metode_kirim->layanan }}</td>
		<td>&nbsp;&nbsp;Rp. {{ number_format($metode_kirim->tarif,2,',','.') }}</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;&nbsp; Total Pembayaran</td>
		<td>&nbsp;&nbsp;<strong>Rp. {{ number_format($total_harga+$metode_kirim->tarif,2,',','.') }}</strong></td>
	</tr>
</table>

<p>
	<strong>Dikirim ke : </strong>
	{{ $pengiriman->atas_nama.' '.$pengiriman->rt.' '.$pengiriman->rw.' '.$pengiriman->kelurahan.' '.$pengiriman->kecamatan.' '.$pengiriman->kota }}
</p>
<p>Bisa di bayar ke :</p>
<table>
	@foreach($bank as $bank)
	<tr>
		<td>{{ $bank->nama_bank }} {{ $bank->rekening }} <br> A/N {{ $bank->atas_nama }}</td>
	</tr>
	@endforeach

</table>

<p> udah bayar? jangan lupa konfirmasi biar pesananmu segera kami proses </p>
<a href="{{ url('pembayaran/konfirmasi/'.$id_order) }}">
	pembayaran/konfirmasi/'{{$id_order}}
</a>

	@include('beautymail::templates.widgets.articleEnd')


@stop