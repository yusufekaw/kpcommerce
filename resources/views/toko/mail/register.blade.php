@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

		<h2>{{ $nama_toko }} ! <small>Registrasi Berhasil</small></h2>
		<h5 class="secondary"><strong>Hai {{ $name }}!</strong></h5>
		<p>Registrasi kamu berhasil</p>
		<p>Sekarang kamu bisa melanjutkan login untuk memulai belanja</p>

	@include('beautymail::templates.widgets.articleEnd')


@stop