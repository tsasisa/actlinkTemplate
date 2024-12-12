<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Public Routes

// Route::get('/', function () {
//     return view('admin.admin');
// });

Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Registration Routes
Route::resource('register', RegisterController::class);
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/check-email', [LoginController::class, 'checkEmail'])->name('login.checkEmail');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/organizer/home', [OrganizerController::class, 'index'])->name('organizer.home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/member/home', [MemberController::class, 'index'])->name('member.home');
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.detail');
Route::post('/events/{id}/register', [EventController::class, 'register'])->name('event.register');