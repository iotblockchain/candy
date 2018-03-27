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

# Route::prefix('candy')->group(function () {

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/captcha', 'CaptchaController@get')->name('captcha');
Route::get('/sms-code', 'SmsCodeController@send')->name('sms');
Route::get('/wallet', 'WalletController@index')->name('wallet');
Route::post('/wallet', 'WalletController@updateAddress');
Route::get('/qr', 'MyQRCodeController@myqr')->name('qr');

# });
