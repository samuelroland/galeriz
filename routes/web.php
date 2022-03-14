<?php

use App\Http\Controllers\GalleryController;
use App\Models\Gallery;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $galleries = Gallery::all();
    return view('galleries.index', ['galleries' => $galleries]);
})->name("panorama");

Route::get('/my', [GalleryController::class, 'myGalleries'])->name("my");

Route::get('/followed', function () {
    $galleries = Gallery::all();
    return view('galleries.index', ['galleries' => $galleries]);
})->name("followedGalleries");

Route::middleware(['auth:sanctum'])->get('/galleries/new', [GalleryController::class, 'store'])->name("galleries.new");

Route::middleware(['auth:sanctum'])->post('/galleries/new', [GalleryController::class, 'store'])->name("galleries.new");

Route::get('/galleries/{gallery}', function (Gallery $gallery) {
    return view('galleries.show', ['gallery' => $gallery]);
})->name("gallery");


Route::redirect('/galleries', '/');

Route::get('/profile', function () {
    return view('profile');
})->name("profile");
