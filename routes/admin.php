<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware(['auth', 'active'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('pages', PageController::class)->except('show');
        Route::resource('services', ServiceController::class)->except('show');

        Route::resource('product-categories', ProductCategoryController::class)->except(['show', 'create', 'edit']);
        Route::resource('products', ProductController::class)->except('show');

        Route::resource('news-categories', NewsCategoryController::class)->except(['show', 'create', 'edit', 'index']);
        Route::resource('news', NewsController::class)->except('show');

        Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
        Route::put('settings/general', [SettingController::class, 'updateGeneral'])->name('settings.general.update');
        Route::get('settings/seo', [SettingController::class, 'seo'])->name('settings.seo');
        Route::put('settings/seo', [SettingController::class, 'updateSeo'])->name('settings.seo.update');

        Route::resource('users', UserController::class)->except('show');
    });
});
