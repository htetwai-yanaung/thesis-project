<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('template::index');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // admin dashboard
    Route::prefix('admin')->middleware(['isAdmin'])->controller(DashboardController::class)->group(function(){
        Route::get('/', 'dashboard')->name('admin.dashboard');
    });

});


