<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.admin');
});
Route::get('/admin-home', [AdminController::class, 'index'])->name('admin.home');

Route::get('/home', [HomeController::class, 'index']);