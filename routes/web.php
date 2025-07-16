<?php

use App\Http\Controllers\AllController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AllController::class, 'index'])->name('home');
Route::get('/debt', [AllController::class, 'debt'])->name('debt');
Route::get('/attendance', [AllController::class, 'attendance'])->name('attendance');
Route::get('/group', [AllController::class, 'group'])->name('group');
Route::get('/settings', [AllController::class, 'settings'])->name('settings');
