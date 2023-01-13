<?php

use App\Http\Controllers\DiscordController;
use App\Http\Controllers\StatistkenController;
use App\Http\Controllers\TeamController;
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
Route::get('/stats', [StatistkenController::class, 'index']);
Route::get('/stats/{uuid}', [StatistkenController::class, 'userStats']);
Route::get('/team', [TeamController::class, 'index']);
Route::get('/regelwerk', function () { return view('rules'); });

Route::get('/impressum', function () { return view('impressum'); });
Route::get('/agb', function () { return view('agb'); });
Route::get('/datenschutz', function () { return view('datenschutz'); });


Route::get('/testWebhook', [DiscordController::class, 'testWebhook']);


require __DIR__.'/auth.php';
