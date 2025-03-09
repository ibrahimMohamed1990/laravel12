<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JobController;
Route::get('/', function () {
    return view('pages.home'); ;
});


Route::get('/posts/{id}', function ( $id ) {
    return 'post ' . $id;
});


// Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index'); 
// Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
// Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show'); 
// Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
Route::resource('jobs', JobController::class);
 



