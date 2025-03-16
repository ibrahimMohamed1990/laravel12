<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;



Route::get('/', function () {
    $jobs = \App\Models\Job::latest()->take(6)->get();
    return view('pages.home')->with('jobs', $jobs);
})->name('home');

Route::resource('jobs', JobController::class)->middleware(['auth', 'verified'])->only(['create','edit', 'update', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'edit', 'update', 'destroy']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class , 'store'])->name('register.store'); 
    Route::get('/login', [LoginController::class , 'login'])->name('login');
    Route::post('/login', [LoginController::class , 'authenticate'])->name('login.auth'); 
    Route::post('/logout', [LoginController::class , 'logout'])->name('logout');
});


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); 
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });






