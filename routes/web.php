<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UpdateWebsiteController;
use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Route;

// ── Installer ──
Route::get('/install', [InstallationController::class, 'index'])->name('install.index');
Route::post('/install', [InstallationController::class, 'install'])->name('install.submit');

// ── Frontend ──
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/profil', [FrontendController::class, 'profil'])->name('profil');
Route::get('/portofolio', [FrontendController::class, 'portofolio'])->name('portofolio');
Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [FrontendController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/layanan', [FrontendController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [FrontendController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [FrontendController::class, 'kirimPesan'])->name('kontak.submit');

// ── Admin Panel ──
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    Route::resource('menus', MenuController::class)->except(['show']);
    Route::resource('sliders', SliderController::class)->except(['show']);
    Route::resource('posts', PostController::class)->except(['show']);
    Route::resource('portfolios', PortfolioController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('partners', PartnerController::class)->except(['show']);
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::put('settings/account', [SettingController::class, 'updateAccount'])->name('settings.account');

    Route::get('update', [UpdateWebsiteController::class, 'index'])->name('update.index');
    Route::post('update/token', [UpdateWebsiteController::class, 'saveToken'])->name('update.token');
    Route::post('update/run', [UpdateWebsiteController::class, 'runCommand'])->name('update.run');
});

// ── Auth (Breeze) ──
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
