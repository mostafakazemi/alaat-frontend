<?php

use Illuminate\Pagination\Paginator;
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

Route::get('/get-block-page/{blockId}', function ($blockId) {
    $ids = \App\Block::pluck('id')->toArray();
    $position = array_search($blockId, $ids);
    $position++;
    return $page = $position % 5 == 0 ? $position / 5 : intval($position / 5 + 1);
});

Route::get('/blocks-api/{page}', function ($page) {
    $currentPage = $page;
    Paginator::currentPageResolver(function() use ($currentPage) {
        return $currentPage;
    });

    return \App\Block::paginate(5);
});

Route::get('/items-api/{id}', function ($id) {
    return \App\Block::find($id)->items()->paginate(5);
});


Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');

