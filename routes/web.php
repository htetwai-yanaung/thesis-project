<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\App\Http\Controllers\UserController;
use Modules\Core\App\Http\Controllers\ProfileController;
use Modules\Core\App\Http\Controllers\DashboardController;
use Modules\Core\App\Http\Controllers\ThesisController;
use Modules\Core\App\Http\Controllers\NewsController;
use Modules\Core\App\Http\Controllers\SettingController;
use Modules\Template\App\Http\Controllers\ProfileController as UserProfileController;
use Modules\Template\App\Http\Controllers\ThesisController as UserThesisController;

Route::get('/', function () {
    return view('template::index');
})->name('dashboard');

// thesis
Route::get('thesis_page',[UserThesisController::class,'index'])->name('thesis#page');
Route::get('thesis_detail',[UserThesisController::class,'detail'])->name('thesis#detail');

// News
Route::get('/news',[NewsController::class,'index'])->name('news');

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
            Route::get('/', 'index')->name('thesis.index');
            Route::get('/create', 'create')->name('thesis.create');
            Route::post('/store', 'store')->name('thesis.store');
            Route::get('{id}/edit', 'edit')->name('thesis.edit');
            Route::post('{id}/update', 'update')->name('thesis.update');
            Route::get('/delete-file', 'deleteFile')->name('thesis.deleteFile');
        });

        // settings
        Route::prefix('settings')->controller(SettingController::class)->group(function() {
            Route::get('/', 'index')->name('settings.index');
            Route::post('/update', 'update')->name('settings.update');
            Route::post('/banner-image', 'storeBannerImage')->name('settings.storeBannerImage');
            Route::get('/banner-image/delete/{image}', 'destroyBannerImage')->name('settings.destroyBannerImage');
        });

        // news
        // Route::prefix('/news')->controller(NewsController::class)->group(function() {
        //     Route::get('/', 'index')->name('news.index');
        //     Route::get('/load-files', 'loadFiles')->name('news.loadFiles');
        //     Route::get('/create', 'create')->name('news.create');
        //     Route::post('/store', 'store')->name('news.store');
        //     // Route::get('/{$id}/edit', 'edit')->name('news.edit');
        //     // Route::post('/{$id}/update', 'update')->name('news.update');
        //     Route::post('/store-temp-file', 'storeTempFile')->name('news.storeTempFile');
        //     Route::delete('/delete-temp-file', 'deleteTempFile')->name('news.deleteTempFile');
        // });
        // Route::resource('news', NewsController::class);

        // news
        Route::prefix('announcement')->controller(NewsController::class)->group(function() {
            Route::get('/', 'index')->name('announcement.index');
            Route::get('/create', 'create')->name('announcement.create');
            Route::get('/edit/{id}', 'edit')->name('announcement.edit');
            Route::post('/store', 'store')->name('announcement.store');
            Route::post('/update/{id}', 'update')->name('announcement.update');
            Route::post('/store-temp-file', 'storeTempFile')->name('announcement.storeTempFile');
            Route::delete('/delete-temp-file', 'deleteTempFile')->name('announcement.deleteTempFile');
        });
    });

    // user
    Route::prefix('profile')->middleware(['isOwner'])->controller(UserProfileController::class)->group(function() {
        Route::get('/{id}', 'index')->name('user.profile');
        Route::get('/{id}/setting', 'setting')->name('user.profile.setting');
        Route::post('/{id}/setting/update', 'settingUpdate')->name('user.profile.setting.update');
    });

    Route::prefix('thesis')->controller(UserThesisController::class)->group(function() {
        Route::get('/create', 'create')->name('user.thesis.create');
        Route::post('/store', 'store')->name('user.thesis.store');
    });
});

Route::prefix('thesis')->controller(ThesisController::class)->group(function() {
    Route::post('/store-temp-file', 'storeTempFile')->name('thesis.storeTempFile');
    Route::delete('/delete-temp-file', 'deleteTempFile')->name('thesis.deleteTempFile');
});




