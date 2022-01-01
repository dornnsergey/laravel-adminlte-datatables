<?php


namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class EmployeeService
{
    public function handleData(Array $data, Employee $employee = null)
    {
        $data['employment_at'] = Carbon::createFromFormat('d.m.y', $data['employment_at']);

        $head = Employee::where('name', $data['head'])->firstOrFail();
        if ($head->level == 5) {
            throw new Exception('This employee can not be as a head.');
        } else {
            $data['head_id'] = $head->id;
        }

        if (key_exists('photo', $data)) {
            if ($employee && $employee->photo) {
                File::delete($employee->photo);
            }
            $path = 'storage/photos/' . time() . '.jpg';
            Image::make($data['photo'])->orientate()->fit(300)->save($path, 80, 'jpg');
            $data['photo'] = $path;
        }
        return $data;
    }
}
