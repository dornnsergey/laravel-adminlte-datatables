<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('test/{employee}', function (\App\Models\Employee $employee) {
   dd($employee->employees);
});
Route::get('upd/{employee}', function (\App\Models\Employee $employee) {
    $employee->update(['head_id' => '1']);
});

Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class);
});
