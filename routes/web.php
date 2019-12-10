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

Route::get('/', 'HomeController@index',function () {
    return view('home');
});

Route::get('/about', function () {
    return view('layouts/about');
});

Route::get('/contact', function () {
    return view('layouts/contact');
});

Route::get('/blog', 'ArtikelController@index');

Route::get('/logincompany', function () {
    return view('auth/logincompany');
});

Route::get('/formlogin', function () {
    return view('auth/formlogin');
});

Route::get('/kandidatfilter', function () {
    return view('layouts/kandidatFilter');
});



Auth::routes();

Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@update_avatar');


// home and welcome
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcome', 'HomeController@welcome')->name('welcome');

// Perusahaan
Route::get('/data', 'HomeController@dashboard')->name('dashboard');
Route::get('/dataartikelperusahaan', 'HomeController@dataartikelperusahaan')->name('dataartikelperusahaan');

// Artikel
Route::post('/data/artikel/loadperusahaan', 'ArtikelController@storeperusahaan')->name('inputartikelperusahaan');
Route::post('data/artikel/edit/updatep/{id}', 'ArtikelController@updateperusahaan')->name('updateperusahaan');


// Kandidat
Route::get('/data', 'HomeController@dashboard')->name('dashboard');
Route::get('/dataartikelkandidat', 'HomeController@dataartikelkandidat')->name('dataartikelkandidat');
// Artikel
Route::post('/data/artikel/loadkandidat', 'ArtikelController@storekandidat')->name('inputartikelkandidat');
Route::post('data/artikel/edit/updatek/{id}', 'ArtikelController@updatekandidat')->name('updatekandidat');

// Route Artikel
Route::get('/blog/{name}','ArtikelController@show')->name('show.artikel');
Route::get('/data/artikel/create', 'ArtikelController@create')->name('createartikel');
Route::get('/data/artikel/edit/{id}', 'ArtikelController@edit')->name('editartikel');
Route::get('/data/artikel/delete/{id}', 'ArtikelController@destroy')->name('deleteartikel');


// Route Kategori
Route::get('/datakategori', 'HomeController@datakategori')->name('datakategori');
Route::get('/blog/kategori/{name}','KategoriController@index')->name('show.kategori');
Route::get('/data/kategori/create', 'KategoriController@create')->name('createkategori');
Route::post('/data/kategori/create/load', 'KategoriController@store')->name('inputkategori');
Route::get('/data/kategori/edit/{id}', 'KategoriController@edit')->name('editkategori');
Route::post('data/kategori/edit/update/{id}', 'KategoriController@update')->name('updatekategori');
Route::get('/data/kategori/delete/{id}', 'KategoriController@destroy')->name('deletekategori');
    // Stored Procedure
Route::post('/data/kategori/load', 'KategoriController@storeWithSP')->name('input.kategori');

// Route Lowongan 
Route::get('/datalowongan', 'HomeController@datalowongan')->name('datalowongan');
Route::get('/data/lowongan/create', 'LowonganController@create')->name('createlowongan');
Route::post('/data/lowongan/create/load', 'LowonganController@store')->name('inputlowongan');
Route::get('/data/lowongan/edit/{id}', 'LowonganController@edit')->name('editlowongan');
Route::post('data/lowongan/edit/update/{id}', 'LowonganController@update')->name('updatelowongan');
Route::get('/data/lowongan/delete/{id}', 'LowonganController@destroy')->name('deletelowongan');  

// Route Kandidat
Route::get('/cari/kandidat/{id}','KandidatController@show')->name('show.kandidat');
Route::get('/detail/{name}','KandidatController@detail')->name('detail.kandidat');
Route::get('/test/skills={skills}', 'KandidatController@skills')->name('group.skills');
Route::get('/test/kota={kota}', 'KandidatController@kota')->name('group.kota');
Route::get('/test/pendidikan={pendidikan}', 'KandidatController@pendidikan')->name('group.pendidikan');

// Detail Kandidat
Route::get('/detail/{name}/datapribadi','DetailController@dataPribadi')->name('detail.datapribadi');
Route::get('/detail/{name}/kontak','DetailController@kontak')->name('detail.kontak');
Route::get('/detail/{name}/pengalamankerja','DetailController@pengalamanKerja')->name('detail.pengalamankerja');
Route::get('/detail/{name}/pelatihan','DetailController@pelatihan')->name('detail.pelatihan');
Route::get('/detail/{name}/portofolio','DetailController@portofolio')->name('detail.portofolio');
Route::get('/detail/{name}/mediasosial','DetailController@mediaSosial')->name('detail.mediasosial');
Route::get('/detail/{name}/minatkeahlian','DetailController@minatKeahlian')->name('detail.minatkeahlian');
Route::get('/detail/{name}/lampiran','DetailController@lampiran')->name('detail.lampiran');

// Detail Perusahaan
Route::get('/detail/perusahaan/{name}','DetailPerusahaanController@index')->name('detail.perusahaan');

// Route Search
Route::post('/search','SearchController@search')->name('search.artikel');
Route::get('/cari/kandidat','SearchController@searchKandidat')->name('search.kandidat');
Route::post("/detail/perusahaan/",'SearchController@searchPerusahaan')->name('cari.perusahaan');

// Route::get('test/{skills}', 'SearchController@cetak');
// Route::get('test', 'SearchController@panggil');

// Route Comment
Route::post('/commentvalid','CommentController@store')->name('inputcomment');
Route::get('/deletecomment/{id}', 'CommentController@destroy')->name('deletecomment');

// Mail
Route::post('/sendEmail', 'SendEmailController@index');

        // ----------------- Multiple Login ----------------- \\

// Tampil Form Login & Register
Route::get('/formlogin/perusahaan', 'Auth\LoginController@showPerusahaanLoginForm');
Route::get('/formlogin/kandidat', 'Auth\LoginController@showKandidatLoginForm');
Route::get('/register/perusahaan', 'Auth\RegisterController@showPerusahaanRegisterForm');
Route::get('/register/kandidat', 'Auth\RegisterController@showKandidatRegisterForm');

// Simpan Data Login & Register
Route::post('/formlogin/perusahaan', 'Auth\LoginController@perusahaanLogin');
Route::post('/formlogin/kandidat', 'Auth\LoginController@kandidatLogin');
Route::post('/register/perusahaan', 'Auth\RegisterController@createPerusahaan');
Route::post('/register/kandidat', 'Auth\RegisterController@createKandidat');


// AutoComplete
Route::get('skills', 'AutoCompleteController@skills')->name('kandidat.skills');
Route::get('kota', 'AutoCompleteController@kota')->name('kandidat.kota');
Route::get('pendidikan', 'AutoCompleteController@pendidikan')->name('kandidat.pendidikan');
Route::get('perusahaan', 'AutoCompleteController@perusahaan')->name('search.perusahaan');

Route::post('profile/{kandidat}/update', 'ProfileController@update')->name('editprofile');

// Wistlist
Route::post('/wistlist', 'WishlistController@store')->name('wishlist.store');
Route::get('/datarekrut', 'WishlistController@index')->name('wishlist.index');
Route::get('/datarekrutKandidat', 'WishlistController@index1')->name('wishlist.index1');
Route::get('/datarekrut/delete/{id}', 'WishlistController@destroy')->name('wishlist.delete');
// Route::resource('/wishlist', 'WishlistController', ['except' => ['create', 'edit', 'show', 'update']]);

// FixRekrut
Route::post('/rekrut', 'FixRekrutController@store')->name('rekrut.store');
// Route::get('/datarekrut', 'FixRekrutController@index')->name('rekrut.index');
Route::get('/rekrut/delete/{id}', 'FixRekrutController@destroy')->name('rekrut.delete');
Route::post('/rekrut/update/{id}', 'FixRekrutController@update')->name('rekrut.update');

// Excel
Route::get('/kandidat/exportexcel' , 'KandidatController@export_excel');