@extends('toko.layouts.app')

@section('content')

<!-- 404 page contain Start  -->
 <div id="404-page-contain">
   <div class="container">
     <div class="row">
       <div class="detail-404">
         <div class="col-md-6 col-sm-6">
           <div class="text-404"> <a href="#"><img src="{{ asset('kors-look/images/404.png') }}" alt="404" title="404" class="img-responsive"></a> </div>
         </div>
         <div class="col-md-6 col-sm-6">
           <div class="error"> <a href="#"><img src="images/error.png" alt="404" title="404" class="img-responsive"></a>
             <p>Halaman gak ditemukan! coba cek lagi URL yang kamu masukin!</p>
             <a class="btn btn-large btn-primary" href="{{ url('/') }}" >Kembali Ke Beranda</a>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- 404 page contain end  --> 

@endsection