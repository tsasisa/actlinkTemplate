<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.admin');
});
Route::get('/admin-home', [AdminController::class, 'index'])->name('admin.home');
