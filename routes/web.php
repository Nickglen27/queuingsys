<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/newad', function () {
    return view('newad');
});

Route::get('/registrar', function () {
    return view('registrar');
});


Route::get('/tv', function () {
    return view('tv');
});

Route::get('/sidebar', function () {
    return view('sidebar');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::delete('/departments/{name}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store'); // Define route name for transactions.store
Route::get('/transactions/by-department/{departmentId}', [TransactionController::class, 'getTransactionsByDepartment']);
Route::get('/departments/all', [DepartmentController::class, 'all'])->name('departments.all');


Route::get('/departments/{departmentId}', [DepartmentController::class, 'getDepartmentById']);


