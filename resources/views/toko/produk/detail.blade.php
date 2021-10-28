<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{ $data['title'] }}</title>
<meta content="" name="description">
<meta content="" name="author">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('kors-look/images/favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('kors-look/images/favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('kors-look/images/favicon.png') }}">
<link href="{{ asset('kors-look/css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('kors-look/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('kors-look/css/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('kors-look/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600,300,700' rel='stylesheet' type='text/css'>
<link href="{{ asset('kors-look/css/owl.carousel.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('kors-look/css/smoothproducts.css') }}">
<style type="text/css">
  
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

</style>

</head>
<body>
@php
  $produk= $data['produk'];
  $gambar_produk=  $data['gambar_produk'];
  $di_keranjang = $data['di_keranjang'];
  $komentar = $data['komentar'];
  $order_count = $data['order_count'];
  $rating_count = $data['rating_count'];
  $rating_counter = $data['rating_counter'];
  $rating_sum = $data['rating_sum'];
  $rating_value = $data['rating_value'];
  $rate = "";
@endphp
<div class="wrapar"> 
  <!-- Header Start-->
  @include('toko.layouts.header')
  <!-- Header End --> 
  
  <!-- Main menu Start -->
  
  <!-- Main menu End --> 
  @include('toko.layouts.menu')
  <!-- offer block Start  -->
  @include('toko.layouts.alert')
  <!-- offer block end  --> 
  
 
  <div id="product-category">
    <div class="container">
      <div class="row">
      @include('toko.layouts.sidemenu')
        <div class="col-md-9 col-sm-8"> 
          <!-- right block Start  -->
          <div id="right">
            <div class="product-detail-view">
              <div class="row">
                <div class="col-md-6">
                  <div class="sp-loading"><img src="images/sp-loading.gif" alt=""><br>
                    LOADING IMAGES</div>
                  <div class="sp-wrap">
                    @foreach($gambar_produk as $gambar_produk)
                    <a class="item" href="{{ url($gambar_produk->path) }}">
                      <img src="{{ asset($gambar_produk->path)}}" alt="">
                    </a>
                    @endforeach
                  </div>
                </div>
                <div class="col-md-6">
                  
                  <div class="product-detail-content">

                    <div class="product-name">
                      <h4><a href="product-detail-view.html">{{ $produk->nama_produk }} </a></h4>
                      @if(Auth::user())
                      @if($order_count>0 && $rating_count==0)

                      <form method="post" action="{{ url('produk/rating') }}">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                        <fieldset class="rating">

                          <input type="radio" id="star5" name="rating" value="5" onclick="form.submit()" />
                          <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                          <input type="radio" id="star4" name="rating" value="4" onclick="form.submit()" />
                          <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                          <input type="radio" id="star3" name="rating" value="3" onclick="form.submit()" />
                          <label class = "full" for="star3" title="Meh - 3 stars"></label>
                          <input type="radio" id="star2" name="rating" value="2" onclick="form.submit()" />
                          <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                          <input type="radio" id="star1" name="rating" value="1" onclick="form.submit()"/>
                          <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        </fieldset>
                      </form>
                        
                      @endif
                      @endif
                    </div>
                    <div class="review"> 
                      <span class="rate">
                      @for($i=0; $i<$rating_value; $i++) 
                        <i class="fa fa-star rated"></i>
                      @endfor
                      @if($rating_value>0)
                      {{ $rating_value }}
                      @endif
                      </span>
                      
                    </div>
                      
                      <br/>
                    <div class="price"> <span class="price-new">Rp. {{ number_format($produk->harga,2,',','.') }}</span> </div>
                    <div class="stock"><span>Stok : </span>{{ $produk->stok-$di_keranjang }} </div>
                    <div class="products-code"> <span>Kode Produk :</span> {{ $produk->id_produk }}</div>
                    <form method="post" action="{{ url('keranjang/beli') }}">
                    <div class="product-qty">
                      <label for="qty">Quantity :</label>
                      <div class="custom-qty">
                        <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>
                        <input type="text" class="input-text qty" title="Qty" value="1" maxlength="3" max="{{ $produk->stok }}" id="qty" name="qty">
                        <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>
                      </div>
                    </div>
                    <div class="add-to-cart">
                      
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                        <input type="hidden" name="max_qty" value="{{ $produk->stok-$di_keranjang }}">
                        @if(Auth::user())
                        <button type="submit" class="btn btn-default">Masukkin Keranjang</button>
                        @else
                        <h4>Mau beli? Login dulu!</h4>
                        @endif

                    </div>
                      </form>

                  </div>
                </div>
              </div>
            </div>
            

            <div class="product-detail-tab">
              <div class="row">
                <div class="col-md-12">
                  <div id="tabs">
                    <ul class="nav nav-tabs">
                      <li><a class="tab-Description selected" title="Description">Deskripsi</a></li>
                      <li><a class="tab-Product-Tags" title="Product-Tags">Komentar</a></li>
                    </ul>
                  </div>
                  <div id="items">
                    <div class="tab-content">
                      <ul>
                        <li>
                          <div class="items-Description selected">
                            <div class="Description"> 
                              {!! $produk->deskripsi !!}
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="items-Product-Tags contact-submit">
                            <table class="table table-responsive table-stripped">
                              @foreach($komentar as $komentar)
                              <tr>
                                <td><i class="fa fa-users"></i> {{ $komentar->role }}</td>
                                <td><i class="fa fa-user"></i> {{ $komentar->nama }}</td>
                                <td><i class="fa fa-calendar"></i> {{ $komentar->tanggal }}</td>
                              </tr>
                              <tr>
                                <td colspan="3">{{ $komentar->komentar }}</td>
                              </tr>
                              @endforeach
                            </table>
                            @if(Auth::user())
                            <form method="post" action="{{ url('produk/komentar') }}">
                              @csrf
                              <div class="input-group">
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
                                <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                                <input type="hidden" name="kode_status" value="1">
                                <input type="hidden" name="status" value="terkirim">
                                <textarea name="komentar" class="form-control" name="contact-message" id="textarea_message" placeholder="Message *" required></textarea>
                              </div>
                              <button type="submit" class="btn btn-default" name="kirim"> kirim Komentar </button>
                            </form>
                            {!! $data['komentar']->render() !!}
                            @endif
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--div class="product-detail-tab">
              <div class="row">
                <div class="col-md-12">
                  <div id="tabs">
                    <ul class="nav nav-tabs">
                      <li><a class="tab-Description selected" title="Description">Description</a></li>
                      <li><a class="tab-Komentar" title="Komentar">Description</a></li>
                      
                    </ul>
                  </div>
                  <div id="items">
                    <div class="tab-content">
                      <ul>
                        <li>
                          <div class="items-Description selected">
                            <div class="Description"> {!! $produk->deskripsi !!} </div>
                          </div>
                        </li>
                        <li>
                          <div class="items-Komentar">
                            <div class="Description"> 

                            </div>
                          </div>
                        </li>
                        
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div-->
          </div>
          <!-- right block end  --> 
        </div>
      </div>
    </div>
  </div>
  
  <!-- Footer block Start  -->
  @include('toko.layouts.footer')
  <!-- Footer block End  --> 
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="{{ asset('kors-look/js/jQuery.js') }}"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="{{ asset('kors-look/bootstrap/js/bootstrap.js') }}"></script> 
<script src="{{ asset('kors-look/js/jquery-ui.js') }}"></script> 
<script src="{{ asset('kors-look/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('kors-look/js/globle.js') }}"></script> 
<script type="text/javascript" src="{{ asset('kors-look/js/smoothproducts.min.js') }}"></script> 
<!-- product tab js --> 

<script type="text/javascript"> 
      $("#tabs li a").click(function(e){
        var title = $(e.currentTarget).attr("title");
        $("#tabs li a").removeClass("selected")
        $(".tab-content li div").removeClass("selected")
        $(".tab-"+title).addClass("selected")
        $(".items-"+title).addClass("selected")
        $("#items").attr("class","tab-"+title);
      });
        $(window).load( function() {
        $('.sp-wrap').smoothproducts();
    });
     </script>
<script src="{{ asset('kors-look/js/globle.js') }}"></script>
</body>
</html>