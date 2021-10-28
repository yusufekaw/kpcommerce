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


</head>
<body>
<div class="wrapar"> 
  <!-- Header Start-->
  @include('toko.layouts.header')
  <!-- Header End --> 
  
  <!-- Main menu Start -->
  @include('toko.layouts.menu')
  <!-- Main menu End --> 
 <!-- Content -->
 @yield('content')
 <!--  end  of content -->
  
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
<!-- jQuery (price shorting) --> 
<script>
    $(function() {
        $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 800,
        values: [ 75, 500 ],
        slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        });
    </script> 

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

 <script src="{{ asset('js/app.js') }}"></script>
 <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>