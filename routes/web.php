<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Talent;
use App\Http\Controllers\Club;
use App\Http\Controllers\Admin;

// Home redirect
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Talent Dashboard
Route::prefix('talent')->name('talent.')->group(function () {
    Route::get('/dashboard', [Talent\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [Talent\ProfileController::class, 'index'])->name('profile');
    Route::get('/opportunities', [Talent\OpportunitiesController::class, 'index'])->name('opportunities');
    Route::get('/applications', [Talent\ApplicationsController::class, 'index'])->name('applications');
    Route::get('/publications', [Talent\PublicationsController::class, 'index'])->name('publications');
    Route::get('/settings', [Talent\SettingsController::class, 'index'])->name('settings');
});

// Club Dashboard
Route::prefix('club')->name('club.')->group(function () {
    Route::get('/dashboard', [Club\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [Club\ProfileController::class, 'index'])->name('profile');
    Route::get('/news', [Club\NewsController::class, 'index'])->name('news');
    Route::get('/offers', [Club\OffersController::class, 'index'])->name('offers');
    Route::get('/publish', [Club\OffersController::class, 'create'])->name('offers.create');
    Route::get('/applications', [Club\ApplicationsController::class, 'index'])->name('applications');
    Route::get('/talents', [Club\TalentsController::class, 'index'])->name('talents');
    Route::get('/settings', [Club\SettingsController::class, 'index'])->name('settings');
});

// Admin Dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/clubs', [Admin\ClubsController::class, 'index'])->name('clubs');
    Route::get('/clubs/{id}', [Admin\ClubsController::class, 'show'])->name('clubs.show');
    Route::get('/talents', [Admin\TalentsController::class, 'index'])->name('talents');
    Route::get('/talents/{id}', [Admin\TalentsController::class, 'show'])->name('talents.show');
    Route::get('/offers', [Admin\OffersController::class, 'index'])->name('offers');
    Route::get('/applications', [Admin\ApplicationsController::class, 'index'])->name('applications');
    Route::get('/news', [Admin\NewsController::class, 'index'])->name('news');
    Route::get('/moderation', [Admin\ModerationController::class, 'index'])->name('moderation');
    Route::get('/stats', [Admin\StatsController::class, 'index'])->name('stats');
    Route::get('/settings', [Admin\SettingsController::class, 'index'])->name('settings');
});
