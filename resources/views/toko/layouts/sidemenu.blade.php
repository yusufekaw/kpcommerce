@php
$kategori = $data['kategori'];
@endphp
<div class="col-md-3 col-sm-4"> 
  <!-- left block Start  -->
  <div id="left">
    <div class="sidebar-block">
      <div class="sidebar-widget Category-block">
        <div class="sidebar-title">
          <h4> Kategori </h4>
        </div>
        <ul class="title-toggle">
          @foreach($kategori as $kategori)
          @php
            $nama_kategori = $kategori->nama_kategori;
            $nama_kategori = str_replace(' ','_',$nama_kategori); 
          @endphp
          <li><a href="{{ url('produk/kategori/'.$kategori->id_kategori.'/nama/'.$nama_kategori) }}">{{ $kategori->nama_kategori }}</a></li>
          @endforeach
        </ul>
      </div>
     
      
      

    </div>
  </div>
  <!-- left block end  --> 
</div>