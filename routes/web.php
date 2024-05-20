<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StudTransController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/KioskInterface', function () {
    return view('KioskInterface');
});

Route::get('/newad', function () {
    return view('newad');
});

Route::get('/registrar', function () {
    return view('registrar');
});

Route::get('/fetch-departments', [DepartmentController::class, 'fetchDepartments']);


// Students

Route::get('/fetch-students', [StudentController::class, 'fetchStudents']);
// Route::post('/students', [StudentController::class, 'store']);
// Route::get('/students/{id}', [StudentController::class, 'show']);
// Route::put('/students/{id}', [StudentController::class, 'update']);
// Route::delete('/students/{id}', [StudentController::class, 'destroy']);

// Nicks Task Routes
Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::delete('/departments/{name}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store'); // Define route name for transactions.store
Route::get('/transactions/by-department/{departmentId}', [TransactionController::class, 'getTransactionsByDepartment']);
Route::get('/departments/all', [DepartmentController::class, 'all'])->name('departments.all');
Route::get('/departments/{departmentId}', [DepartmentController::class, 'getDepartmentById']);
Route::post('/store-details', [StudTransController::class, 'store']);

Route::get('/fetch-studtrans', [StudTransController::class, 'fetchStudTrans']);