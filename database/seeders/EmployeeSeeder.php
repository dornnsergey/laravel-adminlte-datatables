<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Faker\Factory;
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
        function seedEmployees(
            int $countLvl1,
            int $countLvl2 = null,
            int $countLvl3 = null,
            int $countLvl4 = null,
            int $countLvl5 = null
        ): void
        {
            $faker = Factory::create();
            $positions = Position::pluck('id');

            $employees = [];
            foreach (func_get_args() as $count) {
                if ($count) {
                    static $level = 1;
                    static $min = 0;
                    static $max = 0;
                    for ($i = 0; $i < $count; $i++) {
                        $employees[] = [
                            'name'          => $faker->name(),
                            'position_id'   => $positions->random(),
                            'head_id'       => $level != 1 ? rand($min, $max) : null,
                            'level'         => $level,
                            'employment_at' => $faker->dateTimeBetween('-2 years', '-1 week'),
                            'phone'         => $faker->uaPhoneNumber(),
                            'email'         => $faker->unique()->safeEmail(),
                            'salary'        => rand(1, 500) * 1000,
                            'created_at'    => now()->toDateTimeString(),
                            'updated_at'    => now()->toDateTimeString()
                        ];
                    }
                    $level++;
                    $min = $max + 1;
                    $max += $count;
                }
            }
            if (count($employees) > 5000) {
                $chunks = array_chunk($employees, 5000);
                foreach ($chunks as $chunk) {
                    Employee::insert($chunk);
                }
            } else {
                Employee::insert($employees);
            }
        }

        seedEmployees(100, 3000, 10000, 15000, 25000);
    }
}
