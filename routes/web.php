<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Auth::routes([
    'confirm'  => false,
    'verify'   => false,
    'register' => false,
    'reset'    => false
]);
Route::permanentRedirect('/', 'employees');

Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class)->except('show');
    Route::resource('positions', PositionController::class)->except('show');
});
