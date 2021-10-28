@extends('toko.layouts.app')
@section('content')
@php
    $bank = $data['bank'];
    $nominal = $data['nominal'];
    $id_order = $data['id_order'];
@endphp
  <div id="contact-page-contain">
    <div class="container">
    	    <div class="row">
    	      <div class="col-md-offset-2 col-md-8">
    	        <div class="contact-title">
    	          <h2 class="tf">Konfirmasi Pembayaran</h2>
    	          <p class="text-center">Upload bukti pembayaran kamu disini</p>
    	      </div>
    	  </div>
    	</div>
    	<div class="contact-submit">
    	  <form method="post" action="{{ url('pembayaran/upload') }}" enctype="multipart/form-data">
    	     @csrf
             <input type="hidden" name="id_order" value="{{ $id_order }}">
             <input type="hidden" name="nominal" value="{{ $nominal }}">
    	    <div class="col-sm-12">
    	    <div class="input-group">
    	    	<select name="bank_tujuan" class="form-control" required>
                    <option value="">Transfer ke Bank</option> 
                    @foreach($bank as $bank)
                    <option value="{{ $bank->nama_bank.' '.$bank->rekening }}">{{ $bank->nama_bank.' '.$bank->rekening }}</option> 
                    @endforeach     
                </select>
            @error('bank_tujuan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    	    </div>
    	    <div class="input-group">
    	    	<input type="text" name="nama_bank" class="form-control" placeholder="Transfer dari Bank" required>
            @error('nama_bank')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    	    </div>
    	    <div class="input-group">
    	    	<input type="text" name="rekening" class="form-control" placeholder="rekening" required>
    	    </div>
            @error('rekening')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    	    <div class="input-group">
    	    	<input type="text" name="atas_nama" class="form-control" placeholder="atas_nama" required>
            @error('atas_nama')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror    
    	    </div>
    	    <div class="input-group">
                <input type="text" class="form-control" value="{{ $nominal }}" readonly>
    	    </div>
    	    <div class="input-group">
    	    	<input type="file" name="bukti" class="form-control" placeholder="Bukti Transfer" accept="image/*" required>
            @error('bukti')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror    
    	    </div>



    	  <div class="col-md-12 text-center">
    	      <button  type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Konfirmasi Bukti Transfer </button>
    	  </div>
    	</div>
    	
    	</form>
    	</div>
    	</div>

    </div>
  </div>

@endsection