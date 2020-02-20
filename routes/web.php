<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/cv', 'HomeController@createCV')->name('create-cv');

Route::any('/api/exportPdf/{id}', 'PdfApiController@convert_pdf');
Route::any('/api/cv', 'CvApiController@create');
Route::any('/api/cv/detail/{id}', 'CvApiController@detail');
Route::get('/api/cv/{id}', 'CvApiController@get');
Route::any('/api/cv/update/{id}', 'CvApiController@update');

Route::any('/api/current-user', 'SeekerController@getCurrentUser');
Route::post('/api/user/login', 'SeekerController@apiLogin');

Route::get('cvs', 'CvController@index')->name('myCv');

//Profile routes
Route::get('dang-nhap.html', 'SeekerController@login')->name('login');
Route::get('dang-xuat.html', 'SeekerController@logout')->name('logout');
Route::get('dang-ky-tai-khoan-hicv.html', 'SeekerController@register')->name('register');
Route::post('dang-ky-tai-khoan-hicv.html', 'SeekerController@register')->name('register');
Route::get('dang-nhap-tai-khoan-hicv.html', 'SeekerController@loginHicv')->name('loginHicv');
Route::post('dang-nhap-tai-khoan-hicv.html', 'SeekerController@loginHicv')->name('loginHicv');
Route::get('dang-nhap-tai-khoan-{provider}.html', 'Auth\AuthController@redirectToProvider')->name('loginFacebook');
Route::get('dang-nhap-tai-khoan-{provider}.html', 'Auth\AuthController@redirectToProvider')->name('loginGoogle');
Route::get('dang-nhap-tai-khoan-{provider}.html', 'Auth\AuthController@redirectToProvider')->name('loginLinkedin');

Route::get('tai-khoan/doi-mat-khau.html', 'SeekerController@changePassword')->name('changePassword');
Route::post('tai-khoan/doi-mat-khau.html', 'SeekerController@changePassword')->name('changePassword');


//Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/auth-callback.html', 'Auth\AuthController@handleProviderCallback');
Route::get('auth/login-social/{provider}', 'Auth\AuthController@apiLoginBySocial');


// Jobs
Route::get('/viec-lam', 'JobController@index')->name('job-index');
Route::get('/viec-lam/{slug}-{id}.html', 'JobController@detail')->where(['id' => '[0-9]+', 'slug' => '[a-z0-9-]+'])->name('job-detail');