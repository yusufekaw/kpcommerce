@extends('toko.layouts.app')

@section('content')
@php
$kontak = $data['kontak'];
$lokasi= $data['lokasi'];
@endphp

@include('toko.layouts.alert')

<!-- bredcrumb and page title block start  -->
  <div id="bread-crumb">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3">
          <div class="page-title">
            <h4>Kontak Kami</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- bredcrumb and page title block end  -->
  
  <div id="contact-page-contain">
    <div class="container">
      @if($lokasi->latitude != null && $lokasi->latitude != 0)
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="map"> 
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <div style="overflow:hidden;height:300px;width:100%;">
              <div id="gmap_canvas" style="height:300px;width:1170px;"></div>
              <a class="google-map-code" href="http://www.themecircle.net" id="get-map-data">themecircle.net</a></div>
            <script type="text/javascript"> function init_map(){ var isDraggable = $(document).width() > 480 ? true : false; var myOptions = {zoom:14,center:new google.maps.LatLng({!! $lokasi->latitude !!}, {!! $lokasi->longitude !!}), scrollwheel:false, mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng({!! $lokasi->latitude !!}, {!! $lokasi->longitude !!})});infowindow = new google.maps.InfoWindow({content:"Lokasi" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script> 
          </div>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="contact-title">
            <h2 class="tf">Kontak</h2>
            <p class="text-center">Punya pertanyaan, keluhan, kritik dan saran seputar toko kami, jangan sungkan-sungkan kontak kami.</p>
          </div>
        </div>
      </div>
      
      <!--div class="contact-submit">
        <form>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="First Name *" required>
              </div>
              <div class="input-group">
                <input type="email" class="form-control" placeholder="E-mail *" required>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Last Name *" required>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Subject *" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-group">
                <textarea class="form-control" name="contact-message" id="textarea_message" placeholder="Message *"></textarea>
              </div>
              <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="submit"><i class="fa fa-envelope-o"></i> Send </button>
              </div>
            </div>
          </div>
        </form>
      </div-->
      <div class="row">
        @foreach($kontak as $kontak)
        @if( $kontak->urutan < 4 )
        <div class="col-md-4">
          @if($kontak->jenis_kontak=='alamat')
          <div class="address">
          @elseif($kontak->jenis_kontak=='telepon')
          <div class="complaint">
          @else
          <div class="feedback">
          @endif
            <h2 class="tf"><i class="fa {{ $kontak->ikon }}"></i></h2>
            <div class="address-info">{{ $kontak->kontak_info }} </div>
          </div>
        </div>
        @endif
        @endforeach
        <!--div class="col-md-4">
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
        </div-->
      </div>
    </div>
  </div>
@endsection