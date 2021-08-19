<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\CompanyController;
//use Modules\UserManagement\Http\Controllers\UserManagementController;
use Modules\UserManagement\Http\Controllers\RegularUsersController;
use Modules\UserManagement\Http\Controllers\StaffUsersController;

Route::middleware('auth')->group( function() {

    Route::prefix('usermanagement')->group(function () {
     //   Route::get('/', [UserManagementController::class, 'index']);

        // regular users, malley non-production staff and dealers
        Route::prefix('users')->group(function () {
            Route::get('all', [RegularUsersController::class, 'index'])->name('users.index');
            Route::get('{user}', [RegularUsersController::class, 'show'])->name('users.show');
        });

        // companies accounts
        Route::prefix('companies')->group(function () {
            Route::get('create', [CompanyController::class, 'create'])->name('companies.create');
            Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
            Route::get('{company}', [CompanyController::class, 'show'])->name('companies.show');
            Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
        });

        // staff accounts
        Route::prefix('staff')->group(function () {
            Route::get('/create', [StaffUsersController::class, 'create'])->name('staff.create');
            Route::get('/{user}/resetPassword', [StaffUsersController::class, 'resetPassword'])->name('staff.reset_password_form');
            Route::patch('/{user}/resetPassword', [StaffUsersController::class, 'submitResetPassword'])->name('staff.submit_password_reset');
            Route::get('{user}', [StaffUsersController::class, 'show'])->name('staff.show');
            Route::post('/', [StaffUsersController::class, 'store'])->name('staff.store');
            Route::patch('/{user}/toggle', [StaffUsersController::class, 'toggle'])->name('staff.toggle');
            Route::get('/', [StaffUsersController::class, 'index'])->name('staff.index');
        });
    });
});
