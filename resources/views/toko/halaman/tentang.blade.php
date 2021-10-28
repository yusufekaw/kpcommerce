@extends('toko.layouts.app')

@section('content')
@php
$tentang = $data['tentang'];
@endphp

<div id="blog-page-contain">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-8"> 
        
        <!-- left block Start  -->
        <div id="left">
          <div class="single-post-item">
            <div class="single-post-details">
              <div class="post-title">
                <h4><a href="#">{{ $tentang->nama_toko }} | <small>{{ $tentang->tagline }}</small></a></h4>
              </div>
              <div class="description">
                {!! $tentang->deskripsi !!}
              </div>
            </div>
          </div>
        </div>
        <!-- left block end  --> 
      </div>

    </div>
  </div>
</div>
@endsection