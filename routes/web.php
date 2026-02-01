<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/logout/page', function () {
    return view('auth.logout');
})->name('admin.logout.page');

Route::get('/admin/lock/screen', function () {
    return view('auth.lock_screen');
})->name('admin.lock.screen');

Route::get('/check/employee/{id}', [EmployeeController::class, 'VerifyEmployee'])->name('verify.employee');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Employee All Routes 
    Route::controller(EmployeeController::class)->group(function(){
        Route::get('/all/employee', 'ViewEmployee')->name('view.employee');
        Route::get('/add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/store/employee', 'StoreEmployee')->name('store.employee');
        Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/update/employee', 'UpdateEmployee')->name('update.employee');
        Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');
        Route::get('/details/employee/{id}', 'DetailsEmployee')->name('details.employee');
        Route::get('/preview/employee/{id}', 'PreviewEmployee')->name('preview.employee');
        Route::get('/download/pdf/employee/{id}', 'DownloadEmployeePDF')->name('download.pdf.employee');
        Route::get('/download/qrcode/{id}', 'DownloadQRCode')->name('qr_code.download');
    });
});

require __DIR__.'/auth.php';
