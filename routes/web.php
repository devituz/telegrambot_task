<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/debt', [HomeController::class, 'debt'])->name('debt');


Route::get('/group', [HomeController::class, 'group'])->name('group');


Route::get('/settings', function () {
    return view('settings');
})->name('settings');
