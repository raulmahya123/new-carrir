<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\JobCategoryController as AdminJobCategoryController;
use App\Http\Controllers\Admin\LocationController as AdminLocationController;

Route::get('/', fn() => redirect()->route('jobs.index'));

Route::get('/jobs', [JobController::class,'index'])->name('jobs.index');
Route::get('/jobs/{slug}', [JobController::class,'show'])->name('jobs.show');

require __DIR__.'/auth.php';

// Admin area
Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')                // <-- penting: ada titik di akhir
    ->group(function () {
        Route::view('/', 'admin.dashboard')->name('dashboard');

        Route::resource('jobs', AdminJobController::class);          // -> admin.jobs.*
        Route::resource('categories', AdminJobCategoryController::class)
            ->parameters(['categories' => 'job_category']);          // -> admin.categories.*
        Route::resource('locations', AdminLocationController::class);// -> admin.locations.*
    });