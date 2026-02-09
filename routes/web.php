<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/listing', [ListingController::class, 'index'])->name('listing');
Route::get('/listing/{id}', [ListingController::class, 'showListing'])->name('listings.show');
Route::get('listing/reactivate/{id}', [ListingController::class, 'reactivate'])->name('listing.reactivate');
Route::get('/agents', [AgentController::class, 'index'])->name('agents');
Route::get('/agents/{id}', [AgentController::class, 'show'])->name('agents.show');
Route::post('/agents/{id}/contact', [AgentController::class, 'send'])->name('agents.send');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'sendEmail'])->name('contact.send');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/sign-up', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('dashboard/agent')->group(function () {
    Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard.agent');
    Route::post('/listings', [ListingController::class, 'store'])->name('agent.listings.store');
    Route::get('/listings/create', [ListingController::class, 'create'])->name('agent.listings.create');
    Route::get('/listings/{listing}/view', [ListingController::class, 'show'])->name('agent.listings.show');
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('agent.listings.edit');
    Route::put('/agent/listings/{id}', [ListingController::class, 'update'])->name('agent.listings.update');
    Route::delete('/listing/{id}', [ListingController::class, 'destroy'])->name('agent.listings.delete');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/users/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.delete');
Route::get('/admin/listings', [AdminController::class, 'listings'])->name('admin.listings');
Route::get('/admin/listings/{listing}/view', [AdminController::class, 'show'])->name('admin.listings.show');
Route::get('/admin/listings/{listing}/edit', [AdminController::class, 'edit'])->name('admin.listings.edit');
Route::put('/admin/listings/{id}', [AdminController::class, 'update'])->name('admin.listings.update');
Route::delete('/listing/{id}', [AdminController::class, 'destroy'])->name('admin.listings.delete');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('/admin/login', function () {return view('admin.auth.login');})->name('admin.login');
Route::post('admin-login', [AdminController::class, 'postLogin'])->name('admin.post.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
