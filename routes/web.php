<?php

use App\Models\Gallery;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    $galleries = Gallery::all();
    return view('galleries.index', ['galleries' => $galleries]);
})->name("panorama");

Route::get('/my', function () {
    $galleries = Gallery::all();
    return view('galleries.index', ['galleries' => $galleries]);
})->name("my");

Route::get('/followed', function () {
    $galleries = Gallery::all();
    return view('galleries.index', ['galleries' => $galleries]);
})->name("followedGalleries");

Route::get('/galleries/{id}', function (Gallery $gallery) {
    return view('galleries.show', ['gallery' => $gallery]);
})->name("gallery");
