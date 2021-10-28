

<!-- Footer block Start  -->
 <footer id="footer">
   <div class="container">
    <br>
     <div class="row">
       <div class="col-md-3">
         <div class="about">
           <p>{!! $data['toko']->tagline !!}</p>
         </div>
       </div>
       <div class="col-md-3">
         <div class="new-store">
           <h4>Bisa Bayar Pake</h4>
           <ul class="toggle-footer">
             @foreach($data['bank'] as $bank)
             <li><a href="#"><img src="{{ asset($bank->logo) }}" style="width: 150px; height: 50px"></a></li>
             <br>
             @endforeach
           </ul>
         </div>
       </div>
       <div class="col-md-3">
         <div class="information">
           <h4>Bisa Kirim Lewat</h4>
           <ul class="toggle-footer">
            <li><img src="https://www.posindonesia.co.id/photos/1/Logo%20Pos%20Indonesia%20Kecil%20Warna%20Transparan.gif" style="width: 150px; height: 50px"></li>
            <br>
            <li><img src="https://www.jne.co.id/frontend/images/material/logo.jpg" style="width: 150px; height: 50px"></li>
            <br>
            <li><img src="https://www.tiki.id/images/logo/nav.png" style="width: 150px; height: 50px"></li>
           </ul>
         </div>
       </div>
       <div class="col-md-3">
         <div class="contact">
           <h4>Kontak Kami</h4>
           <ul class="toggle-footer">
            @foreach($data['kontak'] as $kontak)
            @if($kontak->urutan < 6 )
             <li>
              <div class="row">
                <div class="col-md-2"> <i class="fa {{ $kontak->ikon }}"></i></div> 
                <div class="col-md-10"> {{ $kontak->kontak_info }} </div>
              </div> 
             </li>
             @endif
            @endforeach
           </ul>
         </div>
       </div>
     </div>
   </div>
   <div class="footer-bottom">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="social-link">
             <ul>
              @foreach($data['kontak'] as $kontak)
              @if($kontak->urutan > 5 )
               <li><a href="{{ $kontak->link }}" target="_blank"><i class="fa {{ $kontak->ikon }}"></i></a></li>
              @endif
              @endforeach
             </ul>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-12">
           <div class="footer-link">
             <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
              @foreach($data['halaman'] as $halaman)
              @php
              $judul = $halaman->judul;
              $judul = str_replace(" ", "_", $judul)
              @endphp
             <li><a href="{{ url('halaman/'.$halaman->id_halaman.'/judul/'.$judul) }}">{{ $halaman->judul }}</a></li>
             @endforeach

                <li><a href="{{ url('halaman/tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ url('halaman/kontak') }}">Kontak Kami</a></li>
             </ul>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-12">
           <div class="copy-right">
             <p> &copy; 2019. Yusuf Eka W.</p>
           </div>
         </div>
       </div>
     </div>
   </div>
 </footer>
 <!-- Footer block End  --> 