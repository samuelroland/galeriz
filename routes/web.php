<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;

//Routes for galleries
Route::controller(GalleryController::class)->group(function () {

    //Guarded routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/galleries/create', 'create')->name("galleries.create");
        Route::post('/galleries', 'store')->name("galleries.store");

        Route::get('/my', 'myGalleries')->name("my");
        Route::get('/followed', 'followedGalleries')->name("followedGalleries");
        Route::get('/galleries/{gallery}/edit', 'update')->name("galleries.update");
    });

    //Public routes
    Route::get('/', 'index')->name("galleries.index");
    Route::get('/galleries/{gallery}', 'show')->name("galleries.show");
});

Route::resource('images', ImageController::class, ['only' => 'show']);

//Redirections and others
Route::get('/galleries', function () {
    return redirect(route('galleries.index'));
});
Route::get('/profile', function () {
    return view('profile');
})->name("profile");
