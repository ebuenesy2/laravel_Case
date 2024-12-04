<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App;

Route::get('/', [App::class,'index']) -> name('index');
Route::get('/{lang}', [App::class,'Index']) -> name("web.index"); //! Web Anasayfa


//! Kullanıcı
Route::get('/{lang}/login', [App::class,'login']) -> name('login'); //! Giriş
Route::post('/login/control', [App::class,'LoginControl']) -> name("login.control"); //! Giriş Kontrol