<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class EmployeeController extends Controller
{
    public function getEmployees(Request $request)
    {
        $token = $request->token;
        $employees = Employee::with('position')->select([
            'employees.id',
            'employees.name',
            'position_id',
            'head_id',
            'employment_at',
            'phone',
            'email',
            'salary',
            'photo'
        ]);

        return Datatables::of($employees)
            ->addColumn('action', function ($employee) {
                return view('employees.column-edit', compact('employee'));
            })
            ->addColumn('delete', function ($employee) use ($token) {
                return view('employees.column-delete', compact('employee', 'token'));
            })
            ->make(true);
    }

    public function getHead(Request $request)
    {
        return Employee::select('name AS label')
                        ->where('level', '<', 5)
                        ->where('name', 'like', '%'.$request->term.'%')
                        ->get()
                        ->toJson();
    }
}
