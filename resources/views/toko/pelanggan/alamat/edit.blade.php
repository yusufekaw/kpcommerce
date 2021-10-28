@extends('toko.layouts.app')
@section('content')
@php
$provinsi = $data['provinsi'];
$alamat = $data['alamat'];
@endphp
<div id="contact-page-contain">
  <div class="container">

    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <div class="contact-title">
          <h2 class="tf">Tambah Alamat</h2>
          <p class="text-center">masukkan alamat untuk pengiriman barang</p>
        </div>
      </div>
    </div>
    <div class="contact-submit">
      <form method="post" action="{{ url('/pelanggan/alamat/update/'.$alamat->id_alamat) }}">
       @csrf
       <input type="hidden" name="ref" value="alamat">
       <div class="row">
        <div class="col-md-6 col-sm-12">
          <!-- /input-group -->
          <div class="input-group">
            <label>Atas nama *</label>
            <input type="text" name="atas_nama" value="{{ $alamat->atas_nama }}" class="form-control" required>
            @error('atas_nama')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <!-- /input-group -->
          <div class="input-group ">
            <label>Nomor Telepon *</label>
            <input type="tel" name="telp" value="{{ $alamat->telp }}" class="form-control" required>
            @error('telp')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <!-- /input-group -->
          <div class="input-group">
            <label>Jenis Alamat(rumah/toko/kantor/dll) *</label>
            <input type="text" name="jenis" value="{{ $alamat->jenis }}" class="form-control"  required>
            @error('jenis')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>

        </div>
        <div class="col-md-6 col-sm-12">


         <!-- /input-group -->
         <div class="input-group">
          <label>Provinsi *</label>
          <select name="provinsi" class="form-control">
            <option value="">--Provinsi--</option>
            @foreach ($provinsi as $provinsi => $value)
            <option value="{{ $provinsi }}"> {{ $value }}</option>   
            @endforeach
          </select>
          @error('provinsi')
              <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- /input-group -->
        <div class="input-group">
          <label>Kota/Kabupaten *</label>
          <select name="kota" class="form-control">
           <option>--Kota/Kabupaten--</option>

         </select>
         @error('kota')
              <p class="text-danger">{{ $message }}</p>
            @enderror
       </div>

       <!-- /input-group -->
       <div class="input-group">
          <label>Kecamatan *</label>
        <input type="text" name="kecamatan" value="{{ $alamat->kecamatan }}" class="form-control" required>
        @error('kecamatan')
              <p class="text-danger">{{ $message }}</p>
            @enderror
      </div>

      <!-- /input-group --> 
      <div class="input-group">
        <label>Kelurahan *</label>
        <input type="text" name="kelurahan" value="{{ $alamat->kelurahan }}" class="form-control" required>
        @error('kelurahan')
              <p class="text-danger">{{ $message }}</p>
            @enderror
      </div>

      <!-- /input-group -->

      <!-- /input-group -->
      <div class="input-group">
        <label>Jalan</label>
        <input type="text" name="jalan" value="{{ $alamat->jalan }}" class="form-control">
      </div>

      <!-- /input-group -->
      <div class="input-group">
        <label>RW *</label>
        <input type="number" name="rw" value="{{ $alamat->rw }}" min="0" class="form-control" required>
        @error('rw')
              <p class="text-danger">{{ $message }}</p>
            @enderror
      </div>

      <!-- /input-group -->
      <div class="input-group">
        <label>RT *</label>
        <input type="number" name="rt" value="{{ $alamat->rt }}" min="0"  class="form-control" required>
        @error('rt')
              <p class="text-danger">{{ $message }}</p>
            @enderror
      </div>





      <!-- /input-group -->
      <div class="input-group">
        <label>Kode Pos *</label>
        <input type="text" name="kodepos" value="{{ $alamat->kodepos }}" class="form-control" required>
        @error('kodepos')
              <p class="text-danger">{{ $message }}</p>
            @enderror
      </div>
      <!-- /input-group -->  
    </div>
    <div class="col-md-12">
      <div class="col-md-12 text-center">
        <button class="btn btn-primary" type="submit"><i class="fa fa-hdd-o"></i> Simpan </button>
      </div>
    </div>
  </div>
</form>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="address">
      <h2 class="tf"><i class="fa fa-map-marker"></i></h2>
      <div class="address-info">Warehouse & Offices 12345 Street name, California, USA </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="complaint">
      <h2 class="tf"><i class="fa fa-mobile"></i></h2>
      <div class="call-info">+91 987-654-321<br>
        <span>+0987-654-321</span> </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="feedback">
        <h2 class="tf"><i class="fa fa-envelope"></i></h2>
        <div class="email-info"> <a href="#">support@lionode.com</a><br>
          <span><a href="#">info@lionode.com</a></span></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/kota.js') }}"></script>
@endsection