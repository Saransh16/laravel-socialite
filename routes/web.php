<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
// Route::get('/auth/google/redirect', function () {
//     return Socialite::driver('google')->redirectUrl('http://localhost:8000/auth/google/redirect')->redirect();
// });

// Route::get('/auth/google/callback', function () {
//     $user = Socialite::driver('google')->stateless()->user();
//     dd($user);
// });

Route::get('/auth/{driver}/redirect', 'LoginController@redirectToProvider')->name('social.oauth');

Route::get('/auth/{driver}/callback', 'LoginController@handleProviderCallback')->name('social.callback');;

Route::get('/', function () {
    return view('welcome');
});
