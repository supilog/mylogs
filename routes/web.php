<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;

Route::controller(LogController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{post}', 'edit')->name('edit');
    Route::put('/update/{post}', 'update')->name('update');
    Route::delete('/destroy/{post}', 'destroy')->name('destroy');
});