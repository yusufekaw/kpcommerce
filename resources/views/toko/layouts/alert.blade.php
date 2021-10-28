<style type="text/css">
.alert-custom{
 	background-color:#d9121f;
	text-align: center;
	color: #ffffff;
}
</style>

<!-- Sukses beli -> masuk keranjang -->
<div id="offer">
	<div class="container">
		@if(session()->get('alert'))
           <div class="alert alert-custom alert-dismissible">
           		<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('alert') }}
            </div>
         @endif
	</div>
</div>
<!-- akhir sukses beli -->

<!-- Gagal Login -->
<div id="offer">
	<div class="container">
		@error('email')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>

<div id="offer">
	<div class="container">
		@error('password')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>
<!-- akhir gagal login -->

<!-- Gagal Daftar -->
<div id="offer">
	<div class="container">
		@error('nama_depan')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>

<div id="offer">
	<div class="container">
		@error('nama_belakang')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>

<div id="offer">
	<div class="container">
		@error('gender')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>

<div id="offer">
	<div class="container">
		@error('email')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>

<div id="offer">
	<div class="container">
		@error('password')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>

<div id="offer">
	<div class="container">
		@error('konfirmasi_password')
		<div class="alert alert-custom alert-dismissible">
			<strong>{{ $message }}</strong>
			<button type="button" class="close btn btn-" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
         @enderror
	</div>
</div>

<!-- akhir gagal daftar -->
