@extends('admin.layout.app')

@section('content')


<form method="post" action="{{ url('admin/produk/save') }}" enctype="multipart/form-data">
@csrf
 <div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3> Tambah Produk </h3>
    </div>

    <div class="title_right">
      <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </div>
  </div>

<div class="clearfix"></div>
<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    @error('nama_depan')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @endif

    @error('stok')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @endif

    @error('harga')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @endif

    @error('berat')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @endif

    @error('deskripsi')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @endif

    @error('id_kategori')
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      {{ $message }}
    </div>
    @endif
    

    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-bars"></i> Tambah Produk</h2>
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
            <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Produk</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Deskripsi</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false">Gambar</a>
            </li>
          </ul>
          <div id="myTabContent2" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in form-horizontal form-label-left" id="tab_content11" aria-labelledby="home-tab">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Produk</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Kategori</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="id_kategori" class="form-control" required>
                    @foreach($data['kategori'] as $kategori)
                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Stok</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="number" name="stok" value="{{ old('stok') }}" min="1" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="number" name="harga" value="{{ old('harga') }}"  minlength="3" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="number" name="berat" value="{{ old('berat') }}"  class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gambar</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="file" name="gambar" class="form-control" required>
                </div>
              </div>
              
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
              <div class="x_content">      
                <textarea id="konten" class="form-control" name="deskripsi" rows="10" cols="50"></textarea>
                
              </div>
            </div>
            
            <div role="tabpanel" class="tab-pane fade" id="tab_content33" aria-labelledby="profile-tab">
              <div class="input-group control-group after-add-more">
                <input type="file" name="path[]" accept="image/*" class="form-control">
                <div class="input-group-btn"> 
                  <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>Tambah</button>
                </div>
              </div>              
            </div>

            <!-- Copy Fields -->
            <div class="copy hide">
              <div class="control-group input-group" style="margin-top:10px">
                <input type="file" name="path[]" class="form-control" placeholder="Enter Name Here">
                <div class="input-group-btn"> 
                  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>Hapus</button>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
</form>

<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<!--script src="http://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script-->

<script>
  var konten = document.getElementById("konten");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
</script>

@endsection