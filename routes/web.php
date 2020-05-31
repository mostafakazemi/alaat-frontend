<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blocks-api', function () {
    return \App\Block::paginate(5);
});

Route::get('/items-api', function () {
    return \App\Block::whereId(25)->with(['items'])->paginate(5);
});
