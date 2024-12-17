<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\CheckMember;
use App\Http\Middleware\CheckOrganizer;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])
    ->middleware(CheckUserRole::class)
    ->name('home');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/check-email', [LoginController::class, 'checkEmail'])->name('login.checkEmail');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::resource('register', RegisterController::class);
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', CheckUserRole::class ])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/events', [AdminController::class, 'events'])->name('events');
    Route::get('/events/create', [AdminController::class, 'createEvent'])->name('createEvent');
    Route::post('/events', [AdminController::class, 'storeEvent'])->name('storeEvent');
    Route::get('/events/{id}/edit', [AdminController::class, 'editEvent'])->name('editEvent');
    Route::put('/events/{eventId}', [AdminController::class, 'updateEvent'])->name('updateEvent');
    Route::get('/events/{id}/delete', [AdminController::class, 'deleteEvent'])->name('deleteEvent');

    // Organizer Management
    Route::get('/organizers', [AdminController::class, 'showOrganizers'])->name('organizers');
    Route::get('/organizers/accept/{organizerId}', [AdminController::class, 'acceptOrganizer'])->name('organizers.accept');
    Route::get('/organizers/decline/{organizerId}', [AdminController::class, 'declineOrganizer'])->name('organizers.decline');
    Route::get('/organizers/edit/{organizerId}', [AdminController::class, 'editOrganizer'])->name('organizers.edit');
    Route::put('/organizers/update/{organizerId}', [AdminController::class, 'updateOrganizer'])->name('organizers.update');

    // Member Management
    Route::get('/members', [AdminController::class, 'indexMember'])->name('members.indexMember');
    Route::get('/members/edit/{memberId}', [AdminController::class, 'editMember'])->name('members.edit');
    Route::put('/members/{memberId}', [AdminController::class, 'updateMember'])->name('members.update');
    Route::delete('/members/{memberId}', [AdminController::class, 'deleteMember'])->name('members.delete');
    Route::put('/members/updateRole/{memberId}', [AdminController::class, 'updateRoleMember'])->name('members.updateRole');
});

// Organizer Routes
Route::middleware(['auth', CheckUserRole::class])->prefix('organizer')->name('organizer.')->group(function () {
    Route::get('/home', [OrganizerController::class, 'index'])->name('home');
    Route::get('/waitingAccept', [OrganizerController::class, 'waitingAccept'])->name('waitingAccept');

});

// Member Routes
Route::middleware(['auth',CheckUserRole::class])->prefix('member')->name('member.')->group(function () {
    Route::get('/home', [MemberController::class, 'index'])->name('home');
    Route::post('/events/{id}/register', [EventController::class, 'register'])->name('event.register');
     Route::get('/registered-events', [EventController::class, 'registeredEvents'])->name('registered.events');
});



// Event Routes (Publicly accessible)
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.detail');
