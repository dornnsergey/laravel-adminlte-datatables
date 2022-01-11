<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee)
    {
        if (auth()->check()) {
            $employee->admin_created_id = auth()->user()->id;
            $employee->admin_updated_id = auth()->user()->id;
        }
        $employee->syncLevel();
    }

    public function updating(Employee $employee)
    {
        $employee->admin_updated_id = auth()->user()->id;
        $oldHead = $employee->getOriginal('head_id');

        if ($employee->head_id != $oldHead) {
            if ($employee->getSubordinates()->isNotEmpty()) {
                foreach ($employee->getSubordinates() as $subordinate) {
                    $subordinate->head_id = $oldHead;
                    $subordinate->syncSubordinatesLevel();
                }
            }
            $employee->syncLevel();
        }
    }

    public function deleting(Employee $employee)
    {
        $newHead = $employee->head_id;

        if ($employee->getSubordinates()->isNotEmpty()) {
            foreach ($employee->getSubordinates() as $subordinate) {
                $subordinate->head_id = $newHead;
                $subordinate->syncSubordinatesLevel();
            }
        }
        $employee->head_id = null;
    }
}
