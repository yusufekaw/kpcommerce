@extends('toko.layouts.app')
@section('content')
@php
$alamat = $data['alamat'];
$id_order = $data['id_order'];
$provinsi = $data['provinsi'];
@endphp
<div class="wrapar"> 
  <div id="checkout-step-contain">
    <div class="container">
      <div class="account-content checkout-staps">

        <div class="products-order checkout billing-information">
          <div class="checkbox">
            <label>
              <input class="addresses-toggle" type="checkbox" data-target="#my-billing-addresses" data-toggle="collapse" value="">
            Ke alamat yang udah ada </label>
          </div>
          <div class="collapse" id="my-billing-addresses">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <th>Alamat</th>
                    <th></th>
                  </tr>
                  @foreach($alamat as $alamat)
                  <form class="billing-info" action="{{ url('pengiriman/simpan') }}" method="post">
                    @csrf
                    <tr>
                      <td>{{ $alamat->atas_nama.' ('.$alamat->jenis.')' }}</td>
                      @if($alamat->jalan==null)
                      <td>
                        {{  $alamat->kelurahan.' RT/RW '.$alamat->rt.'/'.$alamat->rw.' kec. '.$alamat->kecamatan.', '.$alamat->nama_kota.', '.$alamat->nama_provinsi.' '.$alamat->kodepos }}

                      </td>
                      @else
                      <td>
                        {{ $alamat->jalan.', '.$alamat->kelurahan.' RT/RW '.$alamat->rt.'/'.$alamat->rw.' kec. '.$alamat->kecamatan.', '.$alamat->nama_kota.', '.$alamat->nama_provinsi.' '.$alamat->kodepos }}
                      
                      </td>
                      
                      @endif
                      <input type="hidden" name="id_order" value="{{ $id_order }}">
                      <input type="hidden" name="id_alamat" value="{{ $alamat->id_alamat }}">
                      <input type="hidden" name="id_kota" value="{{ $alamat->id_kota }}">
                      <td><button class="btn btn-primary btn-sm" type="submit">&nbsp; Kirim ke alamat ini &nbsp;</button></td>
                    </tr>
                  </form>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
          <form method="post" action="{{ url('pelanggan/alamat/simpan') }}">
           @csrf
           <input type="hidden" name="id_order" value="{{ $id_order }}">
           <input type="hidden" name="ref" value="pengiriman">
           <div class="row">
            <div class="col-md-6 col-sm-12">
              <!-- /input-group -->
              <div class="input-group">
                <input type="text" name="atas_nama" class="form-control" placeholder="Atas Nama *" required>
                @error('atas_nama')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <!-- /input-group -->
              <div class="input-group">
                <input type="tel" name="telp" class="form-control" placeholder="Nomor Telepon *" required>
                @error('jenis')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <!-- /input-group -->
              <div class="input-group">
                <input type="text" name="jenis" class="form-control" placeholder="Jenis (rumah/kantor/dll) *" required>
                @error('telp')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

            </div>
            <div class="col-md-6 col-sm-12">


             <!-- /input-group -->
             <div class="input-group">
              <select name="provinsi" class="form-control">
                <option value="">--Provinsi--</option>
                @foreach ($provinsi as $provinsi => $value)
                <option value="{{ $provinsi }}"> {{ $value }}</option>   
                @endforeach
              </select>
              @error('id_provinsi')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>

            <!-- /input-group -->
            <div class="input-group">
              <select name="kota" class="form-control">
               <option>--Kota/Kabupaten--</option>

             </select>
             @error('id_kota')
             <p class="text-danger">{{ $message }}</p>
             @enderror
           </div>

           <!-- /input-group -->
           <div class="input-group">
            <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan *" required>
            @error('kecamatan')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>

          <!-- /input-group --> 
          <div class="input-group">
            <input type="text" name="kelurahan" class="form-control" placeholder="Desa/Kelurahan *" required>
            @error('kelurahan')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>

          <!-- /input-group -->

          <!-- /input-group -->
          <div class="input-group">
            <input type="text" name="jalan" class="form-control" placeholder="Jalan ">
          </div>

          <!-- /input-group -->
          <div class="input-group">
            <input type="number" name="rw" min="0" class="form-control" placeholder="RW *" required>
            @error('rt')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>

          <!-- /input-group -->
          <div class="input-group">
            <input type="number" name="rt" min="0"  class="form-control" placeholder="RT *" required>
            @error('rw')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>





          <!-- /input-group -->
          <div class="input-group">
            <input type="text" name="kodepos" class="form-control" placeholder="Kode Pos * " required>
            @error('kodepos')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <!-- /input-group -->  
        </div>
        <div class="col-md-12">
          <div class="col-md-12 text-center">
            <button class="btn btn-primary" type="submit"> &nbsp;<i class="fa fa-hdd-o"></i> &nbsp; Kirim ke alamat baru &nbsp; </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/kota.js') }}"></script>
@endsection