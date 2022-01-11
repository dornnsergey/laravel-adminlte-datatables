<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\PositionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('employees', [EmployeeController::class, 'getEmployees'])->name('api.employees.index');
Route::get('positions', [PositionController::class, 'getPositions'])->name('api.positions.index');

Route::get('head', [EmployeeController::class, 'getHead']);
