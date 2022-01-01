<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Models\Employee;
use App\Models\Position;
use App\Services\EmployeeService;
use Exception;



class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $positions = Position::select('id', 'name')->get();

        return view('employees.create', compact('positions'));
    }

    public function store(CreateEmployeeRequest $request)
    {
        try {
            $data = (new EmployeeService())->handleData($request->validated());
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput($request->all());
        }

        if (Employee::create($data)) {
            return redirect()->route('employees.index')->with('success', 'New employee has been created.');
        } else {
           return back()->with('error', 'Employee has not been created. Something went wrong. Please try again.');
        }
    }

    public function edit(Employee $employee)
    {
        $positions = Position::select('id', 'name')->get();

        return view('employees.edit', compact('employee', 'positions'));

    }

    public function update(EditEmployeeRequest $request, Employee $employee)
    {
        try {
            $data = (new EmployeeService())->handleData($request->all(), $employee);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput($request->all());
        }

        if ($employee->update($data)) {
            return redirect()->route('employees.index')
                             ->with('success', 'New employee has been updated.');
        } else {
            return back()->with('error', 'Employee has not been updated. Something went wrong. Please try again.');
        }
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
                         ->with('success', $employee->name . ' has been deleted successfully.');
    }
}
