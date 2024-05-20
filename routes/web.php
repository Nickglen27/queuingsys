<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FinanceDepartmentController;
use App\Http\Controllers\AcademicDepartmentController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('registration.admin');
})->name('admin');

Route::get('/cashier', function () {
    return view('registration.cashier');
})->name('cashier');

Route::get('/registrar', function () {
    return view('registration.registrar');
})->name('registrar');

// Department routes
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

// Category routes
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

// Auth routes
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes();

// Home route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Specific department routes
Route::get('/registration/admin', [DepartmentController::class, 'index'])->name('registration.admin');
Route::get('/registration/cashier', [FinanceDepartmentController::class, 'index'])->name('registration.cashier');
Route::get('/registration/registrar', [AcademicDepartmentController::class, 'index'])->name('registration.registrar');
