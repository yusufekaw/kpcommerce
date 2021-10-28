@php
$halaman = $data['halaman'];
@endphp
<!-- Main menu Start -->
<div id="main-menu">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <button aria-controls= "navbar" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="#" class="navbar-brand">menu</a> </div>
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/') }}">Beranda</a></li>
          @foreach($halaman as $halaman)
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
    </nav>
  </div>
</div>
<!-- Main menu End --> 