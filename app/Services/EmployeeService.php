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

        if ($data['head']) {
            $head = Employee::where('name', $data['head'])->first();
            if (! $head) {
                throw new Exception('This head does not exist.');
            }
            if ($head->level == 5) {
                throw new Exception('This employee can not be as a head.');
            } else {
                $data['head_id'] = $head->id;
            }
        } else {
            $data['head_id'] = null;
        }

        if (key_exists('photo', $data)) {
            if ($employee && $employee->photo) {
                File::delete($employee->photo);
            }

            if (! is_dir(public_path('storage/photos'))) {
                mkdir(public_path('storage/photos'));
            }

            $path = 'storage/photos/' . time() . '.jpg';
            Image::make($data['photo'])->orientate()->fit(300)->save(public_path($path), 80, 'jpg');
            $data['photo'] = $path;
        }
        return $data;
    }
}
