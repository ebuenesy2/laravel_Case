<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App;

Route::get('/', [App::class,'index']) -> name('index');
Route::get('/{lang}', [App::class,'Index']) -> name("web.index"); //! Web Anasayfa


//! Kullanıcı
Route::get('/{lang}/login', [App::class,'login']) -> name('login'); //! Giriş
Route::post('/login/control', [App::class,'LoginControl']) -> name("login.control"); //! Giriş Kontrol


//! Excel
Route::post('customer/import/post', [App::class,'importPost']) -> name('import.post'); //! Import Excel
Route::get('/customer/delete/{id}', [App::class,'CustomerDelete']) -> name("customer.customer"); //! Müşteri Silme
