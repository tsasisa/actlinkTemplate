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
Route::get('/admin-events', [AdminController::class, 'events'])->name('admin.events');
// Route::get('/', [AdminController::class, 'index'])->name('admin.home');

Route::get('/', [HomeController::class, 'index'])->name('home');

//Create Event
Route::get('/admin-events/create', [AdminController::class, 'createEvent'])->name('admin.createEvent');
Route::post('/admin-events', [AdminController::class, 'storeEvent'])->name('admin.storeEvent');

//Edit Event
Route::get('/admin-events/{id}/edit', [AdminController::class, 'editEvent'])->name('admin.editEvent');
Route::put('/admin-events/{eventId}', [AdminController::class, 'updateEvent'])->name('admin.updateEvent');

//Delete Event
Route::get('/admin-events/{id}/delete', [AdminController::class, 'deleteEvent'])->name('admin.deleteEvent');

//User (Public Routes)
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

// ====================ADMIN CONTROL ORGANIZER===========================

Route::get('/admin/organizers', [AdminController::class, 'showOrganizers'])->name('admin.organizers');

// Terima organizer
Route::get('/admin/organizers/accept/{organizerId}', [AdminController::class, 'acceptOrganizer'])->name('admin.organizers.accept');
// Tolak organizer
Route::get('/admin/organizers/decline/{organizerId}', [AdminController::class, 'declineOrganizer'])->name('admin.organizers.decline');

Route::get('/admin/organizers/edit/{organizerId}', [AdminController::class, 'editOrganizer'])->name('admin.organizers.edit');
    
// Update organizer
Route::put('/admin/organizers/update/{organizerId}', [AdminController::class, 'updateOrganizer'])->name('admin.organizers.update');


// ====================ADMIN CONTROL MEMBER===========================

// Menampilkan daftar member

Route::get('/admin/members', [AdminController::class, 'indexMember'])->name('admin.members.indexMember');


// Halaman untuk mengedit member
Route::get('/admin/members/edit/{memberId}', [AdminController::class, 'editMember'])->name('admin.members.editMember');

// Memperbarui data member
Route::put('/admin/members/{memberId}', [AdminController::class, 'updateMember'])->name('admin.members.updateMember');

// Menghapus member
Route::delete('/admin/members/{memberId}', [AdminController::class, 'deleteMember'])->name('admin.members.deleteMember');

// Mengupdate role member (updateRoleMember)
Route::put('/admin/members/updateRole/{memberId}', [AdminController::class, 'updateRoleMember'])->name('admin.members.updateRoleMember');

