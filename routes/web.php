<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/toko', function () {
    return view('toko.index');
});*/

//halaman depan
Route::get('/', 'Toko\ProdukController@index');


Route::get('/file', 'FileController@index')->name('file');
Route::get('/file/add', 'FileController@create')->name('file/add');
Route::post('/file/save', 'FileController@store')->name('file/save');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//user admin routes
Route::get('/admin', 'Admin\DashboardController@index')->name('admin');
Route::get('/pendapatan', 'Admin\DashboardController@cok_json')->name('pendapatan');

Route::get('/admin/toko/pengaturan', 'Admin\TokoController@index')->name('admin/toko/pengaturan');
Route::post('/admin/toko/update/{id}', 'Admin\TokoController@update')->name('admin/toko/update/{id}');
Route::post('/admin/toko/logo/update/{id}', 'Admin\TokoController@logo_update')->name('admin/toko/logo/update/{id}');
Route::post('/admin/toko/lokasi/update', 'Admin\LokasiTokoController@update')->name('admin/toko/lokasi/update');
Route::get('/admin/toko/lokasi/delete', 'Admin\LokasiTokoController@destroy')->name('admin/toko/lokasi/delete');

Route::post('/admin/toko/kontak/save', 'Admin\KontakTokoCOntroller@store')->name('/admin/toko/kontak/save');
Route::get('/admin/toko/kontak/delete/{id}', 'Admin\KontakTokoCOntroller@destroy')->name('/admin/toko/kontak/delete/{id}');
Route::get('/admin/toko/kontak/edit/{id}', 'Admin\KontakTokoCOntroller@edit')->name('/admin/toko/kontak/edit/{id}');
Route::post('/admin/toko/kontak/update/{id}', 'Admin\KontakTokoCOntroller@update')->name('/admin/toko/kontak/update/{id}');

Route::get('/admin/useradmin', 'Admin\userController@index')->name('admin/useradmin');
Route::get('/admin/useradmin/add', 'Admin\userController@create')->name('admin/useradmin/add');
Route::post('/admin/useradmin/save', 'Admin\UserController@store')->name('admin/useradmin/save');
Route::get('/admin/useradmin/edit/{id}', 'Admin\UserController@edit')->name('admin/useradmin/edit/{id}');
Route::post('/admin/useradmin/update/{id}', 'Admin\userController@update')->name('admin/useradmin/update/{id}');
Route::get('/admin/useradmin/delete/{id}','Admin\userController@destroy')->name('/admin/useradmin/delete/{id}');
Route::get('/admin/useradmin/detail/{id}','Admin\userController@show')->name('/admin/useradmin/detail/{id}');
Route::post('/admin/useradmin/avatar/update/{id}','Admin\userController@avatar_update')->name('/admin/useradmin/avatar/update/{id}');
Route::get('/admin/useradmin/edit/password/{id}','Admin\userController@password')->name('/admin/useradmin/edit/password/{id}');
Route::post('/admin/useradmin/update/password/{id}','Admin\userController@password_update')->name('/admin/useradmin/update/password/{id}');

Route::post('/admin/useradmin/login/avatar/update/{id}','Admin\userController@avatar_update')->name('/admin/useradmin/login/avatar/update/{id}');
Route::get('/admin/useradmin/login/profil','Admin\UserLoginController@show')->name('/admin/useradmin/login/profil');
Route::get('/admin/useradmin/login/edit','Admin\UserLoginController@edit')->name('/admin/useradmin/login/edit');
Route::get('/admin/useradmin/login/password/edit','Admin\UserLoginController@password')->name('/admin/useradmin/login/password/edit');
Route::post('/admin/useradmin/login/password/update','Admin\UserLoginController@password_update')->name('/admin/useradmin/login/password/update');

Route::get('/admin/pelanggan', 'Admin\PelangganController@index')->name('admin/pelanggan');
Route::get('/admin/pelanggan/detail/{id}', 'Admin\PelangganController@show')->name('admin/pelanggan/detail/{id}');

Route::get('/admin/kategori', 'Admin\KategoriController@index')->name('admin/kategori');
Route::post('/admin/kategori/save', 'Admin\KategoriController@store')->name('admin/kategori/save');
Route::get('/admin/kategori/edit/{id}', 'Admin\KategoriController@edit')->name('admin/kategori/edit/{id}');
Route::post('/admin/kategori/update/{id}', 'Admin\KategoriController@update')->name('admin/kategori/update/{id}');
Route::get('/admin/kategori/delete/{id}','Admin\KategoriController@destroy')->name('/admin/kategori/delete/{id}');
Route::get('/admin/produk/kategori/{id}','Admin\KategoriController@show')->name('/admin/produk/kategori/{id}');

Route::get('/admin/produk', 'Admin\ProdukController@index')->name('admin/produk');
Route::get('/admin/produk/add', 'Admin\ProdukController@create')->name('admin/produk/add');
Route::post('/admin/produk/save', 'Admin\ProdukController@store')->name('admin/produk/save');
Route::get('/admin/produk/edit/{id}', 'Admin\ProdukController@edit')->name('admin/produk/edit/{id}');
Route::post('/admin/produk/update/{id}', 'Admin\ProdukController@update')->name('admin/produk/update/{id}');
Route::get('/admin/produk/delete/{id}','Admin\ProdukController@destroy')->name('/admin/produk/delete/{id}');
Route::get('/admin/produk/detail/{id}','Admin\ProdukController@show')->name('/admin/produk/detail/{id}');
Route::post('/admin/produk/komentar', 'Admin\KomentarProdukController@store')->name('admin/produk/komentar');
Route::post('/admin/produk/ikon/update/{id}', 'Admin\ProdukController@gambar_update')->name('admin/produk/ikon/update/{id}');

Route::post('/admin/produk/gambar/save', 'Admin\GambarProdukController@store')->name('admin/produk/gambar/save');
Route::post('/admin/produk/gambar/update/{id}', 'Admin\GambarProdukController@update')->name('admin/produk/gambar/update/{id}');
Route::get('/admin/produk/gambar/delete/{id}', 'Admin\GambarProdukController@destroy')->name('admin/produk/gambar/delete/{id}');


Route::get('/admin/bank', 'Admin\BankController@index')->name('admin/bank');
Route::post('/admin/bank/save', 'Admin\BankController@store')->name('admin/bank/save');
Route::get('/admin/bank/detail/{id}', 'Admin\BankController@show')->name('admin/bank/detail/{id}');
Route::get('/admin/bank/edit/{id}', 'Admin\BankController@edit')->name('admin/bank/edit/{id}');
Route::post('/admin/bank/update/{id}', 'Admin\BankController@update')->name('admin/bank/update/{id}');
Route::get('/admin/bank/delete/{id}','Admin\BankController@destroy')->name('/admin/bank/delete/{id}');
Route::post('/admin/bank/logo/update/{id}', 'Admin\BankController@logo_update')->name('admin/bank/logo/update/{id}');

Route::get('/admin/halaman', 'Admin\halamanController@index')->name('admin/halaman');
Route::get('/admin/halaman/add', 'Admin\halamanController@create')->name('admin/halaman/add');
Route::post('/admin/halaman/save', 'Admin\halamanController@store')->name('admin/halaman/save');
Route::get('/admin/halaman/edit/{id}', 'Admin\halamanController@edit')->name('admin/halaman/edit/{id}');
Route::post('/admin/halaman/update/{id}', 'Admin\halamanController@update')->name('admin/halaman/update/{id}');
Route::get('/admin/halaman/{id}', 'Admin\halamanController@show')->name('admin/halaman/{id}');
Route::get('/admin/halaman/delete/{id}','Admin\halamanController@destroy')->name('/admin/halaman/delete/{id}');


Route::get('/admin/order', 'Admin\OrderController@index')->name('admin/order');
Route::post('/admin/order/filter/tanggal', 'Admin\OrderController@filter_tanggal')->name('/admin/order/filter/tanggal');
Route::get('/admin/order/detail/{id}', 'Admin\OrderController@show')->name('admin/order/detail/{id}');

Route::post('/admin/orderhistori/update/{id}', 'Admin\OrderHistoriController@update')->name('admin/orderhistori/update/{id}');

Route::get('admin/penjualan', 'Admin\PenjualanController@index')->name('admin/penjualan');
Route::post('/admin/penjualan/filter/tanggal', 'Admin\PenjualanController@filter_tanggal')->name('/admin/penjualan/filter/tanggal');
Route::get('/admin/penjualan/detail/{id}', 'Admin\PenjualanController@show')->name('/admin/penjualan/detail/{id}');

/*Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');
Route::get('/pelanggan/register', 'PelangganController@create')->name('pelanggan/register');
Route::post('/pelanggan/save', 'PelangganController@store')->name('pelanggan/save');*/


Route::get('/toko', 'Toko\TokoController@index');
Route::get('/pelanggan', 'Toko\PelangganController@index');
//Route::post('pelanggan/login', 'Auth\LoginController@pelangganLogin');
Route::post('/pelanggan/save', 'Toko\PelangganController@store')->name('/pelanggan/save');
Route::get('/pelanggan/alamat/tambah', 'Toko\AlamatPelangganController@create')->name('pelanggan/alamat/tambah');
Route::post('/pelanggan/alamat/simpan', 'Toko\AlamatPelangganController@store')->name('pelanggan/alamat/simpan');
Route::get('/pelanggan/alamat/edit/{id}', 'Toko\AlamatPelangganController@edit')->name('/pelanggan/alamat/edit/{id}');
Route::post('/pelanggan/alamat/update/{id}', 'Toko\AlamatPelangganController@update')->name('/pelanggan/alamat/update/{id}');
Route::get('/pelanggan/alamat/delete/{id}','Toko\AlamatPelangganController@destroy')->name('/pelanggan/alamat/delete/{id}');
Route::post('/pelanggan/ganti_foto','Toko\PelangganController@ganti_foto')->name('/pelanggan/ganti_foto');
Route::get('/pelanggan/edit','Toko\PelangganController@edit')->name('/pelanggan/edit');
Route::get('/pelanggan/edit/password/','Toko\PelangganController@edit_password')->name('/pelanggan/edit/password/');
Route::post('/pelanggan/update/password/{id}','Toko\PelangganController@update_password')->name('/pelanggan/update/password/{id}');
Route::post('/pelanggan/update/password/{id}','Toko\PelangganController@update_password')->name('/pelanggan/update/password/{id}');


Route::get('kota/get/{id}', 'Toko\AlamatPelangganController@getKota');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/keranjang/beli/{id}', 'Toko\KeranjangController@store')->name('/keranjang/beli/{id}');
Route::post('/keranjang/beli', 'Toko\KeranjangController@store2')->name('/keranjang/beli');
Route::get('/keranjang/hapus/{id}', 'Toko\KeranjangController@destroy')->name('/keranjang/hapus/{id}');

Route::get('produk/{id}', 'Toko\ProdukController@show')->name('/produk/{id}');
Route::post('produk/komentar', 'Toko\KomentarProdukController@store')->name('/produk/komentar');
Route::post('produk/sort', 'Toko\ProdukController@sort')->name('/produk/sort');

/*Route::get('produk/cari/{keyword}', [
'as' => '/produk/cari/', 'uses' => 'Toko\ProdukController@search']);*/

Route::post('/produk/cari','Toko\ProdukController@search');
Route::post('/produk/rating','Toko\ProdukRatingController@store')->name('/produk/rating');


Route::get('produk/{id_produk}/nama/{nama_produk}', [
'as' => 'produk', 'uses' => 'Toko\ProdukController@show']);

Route::get('keranjang', 'Toko\KeranjangController@index')->name('keranjang');

Route::post('checkout', 'Toko\OrderController@store')->name('checkout');

Route::post('keranjang/update', 'Toko\KeranjangController@update')->name('keranjang/update');

Route::get('pengiriman/{id}', 'Toko\pengirimanController@create')->name('pengiriman/{id}');
Route::post('pengiriman/simpan', 'Toko\pengirimanController@store')->name('pengiriman/simpan');
Route::post('pengiriman/metode/simpan', 'Toko\MetodePengirimanController@store')->name('pengiriman/metode/simpan');

Route::get('pengiriman/metode/order/{order}/alamat/{alamat}', [
'as' => 'pengiriman/metode', 'uses' => 'Toko\MetodePengirimanController@create']);


Route::get('order/detail/{id}', 'Toko\OrderController@show')->name('order/detail/{id}');
Route::get('order/pembayaran/{id}', 'Toko\PembayaranController@index')->name('order/pembayaran/{id}');
Route::get('order/konfirmasi/{id}', 'Toko\OrderController@create')->name('order/konfirmasi/{id}');
Route::get('order/sukses/{id}', 'Toko\OrderController@show')->name('order/sukses/{id}');
Route::get('order/detail/{id}', 'Toko\OrderController@show')->name('order/detail/{id}');
Route::post('order/konfirmasi/kirim/{id}', 'Toko\OrderController@update')->name('order/konfirmasi//kirim/{id}');
Route::post('order/update_status/{id}', 'Toko\OrderController@update')->name('order/update_status/{id}');

Route::get('pembayaran/konfirmasi/{id}', 'Toko\PembayaranController@create')->name('pembayaran/konfirmasi/{id}');
Route::post('pembayaran/upload', 'Toko\PembayaranController@store')->name('pembayaran/upload');
Route::get('pembayaran/upload/sukses/{id}', 'Toko\PembayaranController@show')->name('pembayaran/upload/sukses/{id}');

Route::get('halaman/{id_halaman}/judul/{judul}', [
'as' => 'halaman', 'uses' => 'Toko\HalamanController@show']);

Route::get('halaman/tentang', 'Toko\HalamanController@tentang')->name('halaman/tentang');
Route::get('halaman/kontak', 'Toko\HalamanController@kontak')->name('halaman/kontak');

Route::get('produk/kategori/{id_kategori}/nama/{nama_kategori}', [
'as' => 'produk/kategori', 'uses' => 'Toko\KategoriController@show']);

Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');
Route::get('testregister','MailController@register');


Auth::routes();
