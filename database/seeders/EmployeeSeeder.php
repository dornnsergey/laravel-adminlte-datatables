<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(1)
            ->has(Employee::factory(5)
                ->has(Employee::factory(5)
                    ->has(Employee::factory(5)
                        ->has(Employee::factory(5)))))->create();
    }
}
