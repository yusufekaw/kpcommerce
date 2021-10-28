@extends('admin.layout.app')

@section('content')

@php
$toko = $data['toko'];
$lokasi = $data['lokasi'];
@endphp

<form method="post" action="{{ url('admin/toko/update/'.$toko->id) }}">
@csrf
 <div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3> Pengaturan Toko </h3>
    </div>

    <div class="title_right">
      <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
      </div>
    </div>
  </div>

<div class="clearfix"></div>
<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    @error('nama_toko')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @enderror

    @error('tagline')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @enderror

    @error('deskripsi')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @enderror

    @error('nama_kontak')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @enderror

    @error('jenis')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @enderror

    @error('kontak_info')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @enderror

    @if(session()->get('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ session()->get('success') }}  
    </div>
    @endif
   

    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-bars"></i> Pengaturan Toko</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab1" class="nav nav-tabs bar_tabs left" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Toko</a>
            </li>
            
            <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Deskripsi</a>
            </li>

            <li role="presentation" class=""><a href="#tab_content44" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Logo Toko</a>
            </li>

            <li role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false">Info Kontak dan Social Media</a>
            </li>

            <li role="presentation" class=""><a href="#tab_content55" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false">Lokasi Toko</a>
            </li>

          </ul>
          <div id="myTabContent2" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in form-horizontal form-label-left" id="tab_content11" aria-labelledby="home-tab">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Toko</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="nama_toko" value="{{ $toko->nama_toko }}" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tag Line</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="tagline" value="{{ $toko->tagline }}" class="form-control" required>
                </div>
              </div>
              
            </div>

            <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
              <div class="x_content">      
                <textarea id="konten" class="form-control" name="deskripsi" rows="10" cols="50">{{ $toko->deskripsi }}</textarea>
                
              </div>
            </div>
        </form>
            <div role="tabpanel" class="tab-pane fade" id="tab_content44" aria-labelledby="profile-tab">
            	<div class="col-md-4 col-sm-12">
            		<img src="{{ asset($toko->logo) }}" style="max-width: 100%; max-height: 100%">
            		<form method="post" action="{{ url('admin/toko/logo/update/'.$toko->id) }}" enctype="multipart/form-data">
            			@csrf
            			<label class="btn"> Ganti Logo
            				<input type="file" name="logo" style="visibility: hidden;" onchange="form.submit();">
            			</label>
            		</form>
            	</div>
            </div>
            
            <div role="tabpanel" class="tab-pane fade" id="tab_content33" aria-labelledby="profile-tab">
              <div class="row">
              	<div class="col-md-8 col-sm-12">
              		<table class="table table-striped">
              			<thead>
	              		<tr>
	              			<th>Nama</th>
	              			<th>Tipe</th>
	              			<th>Kontak</th>
	              			<th>Aksi</th>
	              		</tr>
	              		@foreach($data['kontak'] as $kontak)
	              		<tr>
	              			<td>{{ $kontak->nama_kontak }}</td>
	              			<td>{{ $kontak->jenis_kontak }}</td>
	              			<td>{{ $kontak->kontak_info }}</td>
	              			<td>
	              				<a href="{{ url('admin/toko/kontak/edit/'.$kontak->id_kontak) }}" class="btn btn-warning">
	              					<i class="fa fa-edit"></i>
	              				</a>
	              				<a href="{{ url('admin/toko/kontak/delete/'.$kontak->id_kontak) }}" class="btn btn-danger">
	              					<i class="fa fa-trash"></i>
	              				</a>
	              			</td>
	              		</tr>
	              		@endforeach
	              	</thead>
	              </table>		
              	</div>

              	<div class="col-md-4 col-sm-12">
              		<form method="post" action="{{ url('admin/toko/kontak/save') }}">
              			@csrf
              			<label for="nama">Nama Kontak</label>
              			<input type="text" id="nama_kontak" class="form-control" name="nama_kontak" required="">
              			<label for="jenis_kontak">Jenis Kontak</label>
              			<select name="jenis_kontak" id="jenis_kontak" class="form-control" required="">
              				<option>-</option>
              				<option value="alamat 1 fa-map-marker">Alamat</option>
              				<option value="email 2 fa-envelope">Email</option>
              				<option value="telepon 3 fa-mobile">Telepon</option>
              				<option value="whatsapp 4 fa-whatsapp">whatsapp</option>
              				<option value="telegram 5 fa-paper-plane">Telegram</option>
              				<option value="facebook 6 fa-facebook">Facebook</option>
              				<option value="twitter 7 fa-twitter">Twitter</option>
              				<option value="instagram 8 fa-instagram">Instagram</option>
              			</select>
              			<label for="kontak_info">Kontak</label>
              			<input type="text" id="kontak_info" class="form-control" name="kontak_info" required="">
                    <label for="kontak">Link</label>
                    <input type="url" id="link" class="form-control" name="link">
              			<hr/>
              			<button type="submit" class="btn btn-success btn-block">Simpan Kontak</button>
              		</form>
              	</div>

              </div>
                            
            </div>

            <div role="tabpanel" class="tab-pane fade" id="tab_content55" aria-labelledby="profile-tab">
              <div class="row">
                  <form method="post" action="{{ url('admin/toko/lokasi/update') }}" class="form-horizontal form-label-left">
                    @csrf
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jalan">Jalan</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="jalan" name="jalan" value="{{ $lokasi->jalan }}" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rt">RT 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="rt" name="rt" value="{{ $lokasi->rt }}" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rw">RW 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="rw" name="rw" value="{{ $lokasi->rw }}" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kelurahan" class="control-label col-md-3 col-sm-3 col-xs-12">Desa / Kelurahan</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="kelurahan" name="kelurahan" value="{{ $lokasi->kelurahan }}" class="form-control col-md-7 col-xs-12" type="text" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kecamatan" class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="kecamatan" name="kecamatan" value="{{ $lokasi->kecamatan }}" class="form-control col-md-7 col-xs-12" type="text" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kota" class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten / Kota </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="kota" name="kota" value="{{ $lokasi->kota }}" class="form-control col-md-7 col-xs-12" type="text" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="provinsi" class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="provinsi" name="provinsi" value="{{ $lokasi->provinsi }}" class="form-control col-md-7 col-xs-12" type="text" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kodepos" class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="kodepos" name="kodepos" value="{{ $lokasi->kodepos }}" class="form-control col-md-7 col-xs-12" type="text" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitude">Latitude 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="latitude" name="latitude" value="{{ $lokasi->latitude }}" class="form-control col-md-7 col-xs-12">
                        <span class="required">Isi dengan 0 bila tidak beralamat</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longitude">Longitude </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="longitude" name="longitude" value="{{ $lokasi->longitude }}" class="form-control col-md-7 col-xs-12">
                        <span class="required">Isi dengan 0 bila tidak beralamat</span>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Simpan Lokasi Toko</button>
                        <a class="btn btn-success" href="{{ url('admin/toko/lokasi/delete/') }}">Hanya Online</a>
                        <button type="button" class="pull-right btn btn-success" data-toggle="modal" data-target="#modal-default">
                          <span class="fa fa-map"></span> Cari Koordinat di Map
                        </button>
                      </div>
                    </div>
                  </form>
                
              </div>
                            
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade modal-xl" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cari Koordinat Lokasi di Peta</h4>
        </div>
        <div class="modal-body">
          <div id="map" style="width: 100%; height: 400px;">
          </div>                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> Tetapkan Koordinat</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->



<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<!--script src="http://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script-->

<script>
  var konten = document.getElementById("konten");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
</script>

<script type="text/javascript">
    //* Fungsi untuk mendapatkan nilai latitude longitude
    function updateMarkerPosition(latLng) {
      document.getElementById('latitude').value = [latLng.lat()]
      document.getElementById('longitude').value = [latLng.lng()]
    }

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: new google.maps.LatLng(0,0),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
//posisi awal marker   
var latLng = new google.maps.LatLng(0,0);

/* buat marker yang bisa di drag lalu 
  panggil fungsi updateMarkerPosition(latLng)
 dan letakan posisi terakhir di id=latitude dan id=longitude
 */
 var marker = new google.maps.Marker({
  position : latLng,
  title : 'lokasi',
  map : map,
  draggable : true
});

 updateMarkerPosition(latLng);
 google.maps.event.addListener(marker, 'drag', function() {
 // ketika marker di drag, otomatis nilai latitude dan longitude
 //menyesuaikan dengan posisi marker 
 updateMarkerPosition(marker.getPosition());
});
</script>

@endsection