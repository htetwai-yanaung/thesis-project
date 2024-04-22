<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\App\Http\Controllers\UserController;
use Modules\Core\App\Http\Controllers\ThesisController;
use Modules\Core\App\Http\Controllers\ProfileController;
use Modules\Core\App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('template::index');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // admin
    Route::prefix('admin')->middleware(['isAdmin'])->group(function(){
        // dashboard
        Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        // profile
        // Route::resource('/profile', ProfileController::class);
        Route::prefix('profile')->controller(ProfileController::class)->group(function() {
            Route::get('/edit/{id}', 'edit')->name('profile.edit');
            Route::post('/update/{id}', 'update')->name('profile.update');
        });

        // teacher
        Route::prefix('teacher')->controller(UserController::class)->group(function() {
            Route::get('/', 'teacherList')->name('teacher.index');
            Route::get('/{id}/delete', 'destroy')->name('teacher.delete');
        });

        // student
        Route::prefix('student')->controller(UserController::class)->group(function() {
            Route::get('/', 'studentList')->name('student.index');
            Route::get('/{id}/delete', 'destroy')->name('student.delete');
        });

        // thesis
        Route::prefix('thesis')->controller(ThesisController::class)->group(function() {
            Route::get('/create', 'create')->name('thesis.create');
            Route::post('/store', 'store')->name('thesis.store');
        });
    });

});


