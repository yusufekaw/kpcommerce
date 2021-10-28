@extends('toko.layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('datatable/datatables.min.css') }}"/>
 
<script type="text/javascript" src="{{ asset('datatable/datatables.min.js') }}"></script>
@php
  $alamat = $data['alamat'];
  $order = $data['order'];
@endphp

 @include('toko.layouts.alert')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-8"> 
          <!-- right block Start  -->
          <div id="right">
            <div class="product-detail-view">
              <div class="row">
                <div class="col-md-2">
                  <img src="{{ asset(Auth::user()->avatar) }}" class="img-fluid img-thumbnail">
                  <form method="post" action="{{ url('pelanggan/ganti_foto') }}" enctype="multipart/form-data">
                    @csrf
                  <label class="btn btn-default btn-block"><span class="fa fa-image"></span> Ganti Foto               
                    <input type="file" name="avatar" class="btn btn-default" style="display: none" onchange="form.submit()">
                  </label>
                  </form>
                  <a class="btn btn-default btn-block" href="{{ url('pelanggan/edit') }}">
                    <span class="fa fa-edit"></span> Ganti Profil
                  </a>
                  <a class="btn btn-default btn-block" href="{{ url('pelanggan/edit/password') }}">
                    <span class="fa fa-edit"></span> Ganti Password
                  </a>
                  <a class="btn btn-default btn-block" href="{{ url('pelanggan/alamat/tambah') }}">
                    <span class="fa fa-plus"></span> Tambah Alamat
                  </a>
                </div>
                <div class="col-md-10">
                    <div class="product-detail-tab">
                      <div class="row">
                        <div class="col-md-12">
                          <div id="tabs">
                            <ul class="nav nav-tabs">
                              <li><a class="tab-Description selected" title="Description">Profil</a></li>
                              <li><a class="tab-Product-Tags" title="Product-Tags">Alamat</a></li>
                              <li><a class="tab-Reviews" title="Reviews">Order</a></li>
                            </ul>
                          </div>
                          <div id="items">
                            <div class="tab-content">
                              <ul>
                                <li>
                                  <div class="items-Description selected">
                                    <div class="Description">
                                      <table class="table table-stripped table-responsive">
                                        <tbody>
                                          <tr>
                                            <th> Nama </th>
                                            <td> &nbsp; </td>
                                            <td> &nbsp;{{ Auth::user()->nama_depan.' '.Auth::user()->nama_belakang}} </td>
                                          </tr>
                                          <tr>
                                            <th> Email </th>
                                            <td> &nbsp; </td>
                                            <td> &nbsp;{{ Auth::user()->email}} </td>
                                          </tr>
                                          <tr>
                                            <th> Jenis Kelamin </th>
                                            <td> &nbsp; </td>
                                            <td>
                                              &nbsp;
                                              @if(Auth::user()->gender == 'l')
                                                Laki-laki
                                              @else
                                                Perempuan
                                              @endif
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table> 
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="items-Product-Tags ">
                                    <table class="table table-stripped table-responsive">
                                      <tbody>
                                        @foreach($alamat as $alamat)
                                        <tr>

                                          @if($alamat->jalan==null)
                                          <td>
                                            <span class="fa fa-user"></span>&nbsp;&nbsp;&nbsp; 
                                            {{ $alamat->atas_nama.' ('.$alamat->jenis.')' }}  
                                            <br> 
                                            <span class="fa fa-map-marker"></span>&nbsp;&nbsp;&nbsp; 
                                            {{ $alamat->kelurahan }} RT/RW {{ $alamat->rt.'/'.$alamat->rw }}
                                            kec. {{ $alamat->kecamatan }}, {{$alamat->kota}}, {{ $alamat->provinsi }}. {{ $alamat->kodepos }}
                                            <br> 
                                            <span  class="fa fa-phone"></span> &nbsp;{{ $alamat->telp }}

                                          </td>
                                          @else
                                          <td>
                                            <span class="fa fa-user"></span>&nbsp;&nbsp;&nbsp;
                                            {{ $alamat->atas_nama.' ('.$alamat->jenis.')' }}  
                                            <br> 
                                            <span class="fa fa-map-marker"></span>&nbsp;&nbsp;&nbsp;
                                            {{ $alamat->jalan }}, {{ $alamat->kelurahan }} RT/RW {{ $alamat->rt.'/'.$alamat->rw }}
                                            kec. {{ $alamat->kecamatan }}, {{$alamat->nama_kota}}, {{ $alamat->nama_provinsi }}. {{ $alamat->kodepos }}
                                            <br> 
                                            <span  class="fa fa-phone"></span> &nbsp;&nbsp;&nbsp;{{ $alamat->telp }}
                                          </td>
                                          @endif
                                          <td>
                                            <a class="btn btn-sm btn-warning" href="{{ url('pelanggan/alamat/edit/'.$alamat->id_alamat) }}">
                                              <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ url('pelanggan/alamat/delete/'.$alamat->id_alamat) }}" onclick="confirm('yakin hapus alamat ini?');">
                                              <span class="fa fa-trash"></span>
                                            </a>
                                          </td>

                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </li>
                                <li>
                                  <div class="items-Reviews" id="example">
                                    <table class="table table-stripped table-responsive">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                         @foreach($order as $order)
                                         <tr>
                                           <td>
                                            <a href="{{ url('order/detail/'.$order->id_order) }}">
                                              {{ $order->id_order }}
                                            </a>
                                          </td>
                                           <td>{{ $order->status }}</td>
                                           <td>{{ $order->created_at }}</td>
                                         </tr>
                                         @endforeach
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                          </tr>
                                        </tfoot>
                                      </table> 
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            &nbsp;
            

            

          </div>
          <!-- right block end  --> 
      </div>
    </div>
</div>         
@endsection

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

<script type="text/javascript">
  $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#example tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      } );
   
      // DataTable
      var table = $('#example').DataTable();
   
      // Apply the search
      table.columns().every( function () {
          var that = this;
   
          $( 'input', this.footer() ).on( 'keyup change clear', function () {
              if ( that.search() !== this.value ) {
                  that
                      .search( this.value )
                      .draw();
              }
          } );
      } );
  } );
</script>