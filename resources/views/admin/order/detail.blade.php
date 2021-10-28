@extends('admin.layout.app')

@section('content')

@php 
$order_detail = $data['order_detail'];
$bayar = $data['bayar'];
$order_histori = $data['order_histori'];
$order_item_all = $data['order_item_all'];
$order_item_sum = $data['order_item_sum'];
$pengiriman = $data['pengiriman'];
error_reporting(0);
@endphp

<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3> Order </h3>
    </div>

  </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2><i class="fa fa-bars"></i> Vertical Tabs <small>Float left</small></h2>
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

        <div class="col-xs-3">
          <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left">


            <li class="active"><a href="#detail" data-toggle="tab">Detail Order</a>
            </li>
            <li><a href="#bukti" data-toggle="tab">Bukti Pembayaran</a>
            </li>
            <li><a href="#produk" data-toggle="tab">Produk dibeli</a>
            </li>
            <li><a href="#riwayat" data-toggle="tab">Riwayat Order</a>
            </li>
            <li><a href="#kirim" data-toggle="tab">Pengiriman</a>
            </li>

        </ul>
    </div>

    <div class="col-xs-9">
      <!-- Tab panes -->
      <div class="tab-content">


        <div class="tab-pane active" id="detail">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $order_detail->id_order }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>{{ $order_detail->nama_depan }} {{ $order_detail->nama_belakang }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $order_detail->status }}</td>
                </tr>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td>{{ $order_detail->created_at->format('d/M/Y H:i:s') }}</td>
                </tr>
            </table>
            <div class="pull-right">
                @if($order_detail->status=='lunas')
                <form method="post" action="{{url('admin/orderhistori/update/'.$order_detail->id_order)}}">
                    @csrf
                    <input type="hidden" name="ref" value="order_detail">
                    <input type="hidden" name="email" value="{{ $order_detail->email }}">
                    <input type="hidden" name="nama_depan" value="{{ $order_detail->nama_depan }}">
                    <input type="hidden" name="nama_belakang" value="{{ $order_detail->nama_belakang }}">
                    <button type="submit" class="btn btn-success" name="packing" value="packing">
                        <i class="fa fa-check"> Sudah di packing </i>
                    </button>
                </form>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="bukti">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <a href="{{ url($bayar->bukti) }}" target="_blank">
                        <img src="{{ asset($bayar->bukti) }}" style="max-width: 100%" height="300px">
                    </a>
                </div>
                <div class="col-sm-8 col-xs-12">
                    <table class="table table-bordered table-responsive">
                        
                        <tr>
                            <th>ID</th>
                            <td>{{ $bayar->id_pembayaran }}</td>
                        </tr>
                        <tr>
                            <th>Ke</th>
                            <td>{!! $bayar->bank_tujuan !!}</td>
                        </tr>
                        <tr>
                            <th>Dari</th>
                            <td>
                                {!! $bayar->nama_bank.' '.$bayar->rekening.'<br>a/n '.$bayar->atas_nama !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td>{{ $bayar->nominal }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Upload</th>
                            <td>{{ $bayar->created_at }}</td>
                        </tr>
                    </table>
                    <div class="pull-right">
                        @if($order_detail->kode_status=='3')
                        <form method="post" action="{{url('admin/orderhistori/update/'.$order_detail->id_order)}}">
                            @csrf
                            <input type="hidden" name="ref" value="order_detail">
                            <input type="hidden" name="email" value="{{ $order_detail->email }}">
                            <input type="hidden" name="nama_depan" value="{{ $order_detail->nama_depan }}">
                            <input type="hidden" name="nama_belakang" value="{{ $order_detail->nama_belakang }}">
                            <button type="submit" class="btn btn-success" name="verifikasi1" value="lunas">
                                <i class="fa fa-check"> Verifikasi Pembayaran </i>
                            </button>
                            <button type="submit" class="btn btn-danger" name="verifikasi2" value="tolak">
                                <span class="fa fa-close"> Tolak Pembayaran </span>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="produk">
            <table class="table table-bordered">
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
                @foreach($order_item_all as $item)
                <tr>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp. {{ number_format($item->total_harga,2,",",".") }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">Total Produk</td>
                    <td>Rp. {{ number_format($order_item_sum,2,",",".") }}</td>
                </tr>
                <tr>
                    <td colspan="2">Ongkir</td>
                    <td>Rp. {{ number_format($pengiriman->tarif,2,",",".") }}</td>
                </tr>
                <tr>
                    <td colspan="2">Total Bayar</td>
                    <td> 
                        <strong>Rp. {{ number_format($pengiriman->tarif+$order_item_sum,2,",",".") }}</strong>
                    </td>
                </tr>
            </table>
        </div>
        <div class="tab-pane" id="riwayat">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
                @foreach($order_histori as $histori)
                <tr>
                    <td>{{ $histori->created_at }}</td>
                    <td>{{ $histori->status }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="tab-pane" id="kirim">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Kepada</th>
                            <td>{{ $pengiriman->atas_nama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            @if($pengiriman->jalan==null)
                            <td>
                                {{ $pengiriman->kelurahan }} RT/RW {{ $pengiriman->rt.'/'.$pengiriman->rw }}
                                kec. {{ $pengiriman->kecamatan }}, {{$pengiriman->kota}}, {{ $pengiriman->provinsi }}. {{ $pengiriman->kodepos }}
                                <br> 
                                <span  class="fa fa-phone"></span> &nbsp;{{ $pengiriman->telp }}

                            </td>
                            @else
                            <td>
                                {{ $pengiriman->jalan }}, {{ $pengiriman->kelurahan }} RT/RW {{ $pengiriman->rt.'/'.$pengiriman->rw }}
                                kec. {{ $pengiriman->kecamatan }}, {{$pengiriman->nama_kota}}, {{ $pengiriman->nama_provinsi }}. {{ $pengiriman->kodepos }}
                                <br> 
                                <span  class="fa fa-phone"></span> &nbsp;&nbsp;&nbsp;{{ $pengiriman->telp }}
                            </td>
                            @endif
                        </tr>
                    </table>
                    @if($order_detail->kode_status!='7')
                    <form method="post" action="{{url('admin/orderhistori/update/'.$order_detail->id_order)}}">
                        @csrf
                        <input type="hidden" name="ref" value="order_detail">
                        <input type="hidden" name="email" value="{{ $order_detail->email }}">
                        <input type="hidden" name="nama_depan" value="{{ $order_detail->nama_depan }}">
                        <input type="hidden" name="nama_belakang" value="{{ $order_detail->nama_belakang }}">
                        <button type="submit" class="btn btn-success" name="dikirim" value="dikirim">
                            <i class="fa fa-check"> Sudah di kirim </i>
                        </button>
                    </form>
                    @endif                                  
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

@endsection