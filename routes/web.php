<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\DocumentsSubsController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StandardsController;
use App\Http\Controllers\SubsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VerifyController;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/login');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::resource('/standar', DocumentsController::class, [
        'names' => [
            'create' => 'documents.create',
            'store' => 'documents.store',
            'index' => 'documents.index',
        ],
    ])->only('create', 'store', 'index');

    Route::get('/standar/{standard}/sub', [DocumentsSubsController::class, 'index'])
        ->whereNumber('standard')
        ->name('documents.subs.index');
    Route::get('/standar/{standard}/sub/{sub}', [DocumentsSubsController::class, 'show'])
        ->name('documents.subs.show');
    Route::delete('/standar/sub/{document}', [DocumentsSubsController::class, 'destroy'])
        ->name('documents.subs.destroy');

    Route::get('/verifikasi', [VerifyController::class, 'index'])
        ->name('verify.index');
    Route::post('/verifikasi/{document}', [VerifyController::class, 'verifikasiDokumen'])
        ->name('verify.document');

    Route::get('/sub', [SubsController::class, 'index'])
        ->name('subs.index');
    Route::get('/sub/tambah', [SubsController::class, 'create'])
        ->name('subs.create');
    Route::post('/sub', [SubsController::class, 'store'])
        ->name('subs.store');
    Route::delete('/sub/{sub}', [SubsController::class, 'destroy'])
        ->name('subs.destroy');
    Route::get('/sub/{sub}/edit', [SubsController::class, 'edit'])
        ->name('subs.edit');
    Route::patch('/sub/{sub}', [SubsController::class, 'update'])
        ->name('subs.update');

    Route::resource('/standard', StandardsController::class)
        ->only(['index', 'create', 'update', 'edit', 'destroy']);

    Route::get('/pengguna', [UsersController::class, 'index'])
        ->name('users.index');
    Route::get('/pengguna/tambah', [UsersController::class, 'create'])
        ->name('users.create');
    Route::post('/pengguna', [UsersController::class, 'store'])
        ->name('users.store');
    Route::delete('/pengguna/{user}', [UsersController::class, 'destory'])
        ->name('users.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'password'])
        ->name('profile.password');

    Route::get('/download/{id}', DownloadsController::class)
        ->whereNumber('id')
        ->name('download');
});
