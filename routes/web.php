<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('home'); });

Route::get('/shop', function () { return view('shop'); });
Route::get('/stats', function () { return view('stats'); });
Route::get('/team', function () { return view('team'); });

Route::get('/impressum', function () { return view('impressum'); });
Route::get('/agb', function () { return view('agb'); });
Route::get('/datenschutz', function () { return view('datenschutz'); });


require __DIR__.'/auth.php';
