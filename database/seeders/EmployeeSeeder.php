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
        $faker = Factory::create();
        $positions = Position::pluck('id');

        $level1 = [];
        for ($i = 0; $i < 100; $i++) {
            $level1[] = [
                'name' => $faker->name(),
                'position_id' => $positions->random(),
                'employment_at' => $faker->dateTimeBetween('-2 years', '-1 week'),
                'phone' => $faker->uaPhoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'salary' => rand(1, 500) * 1000,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }
        Employee::insert($level1);


        $level2 = [];
        for ($i = 0; $i < 3000; $i++) {
            $level2[] = [
                'name' => $faker->name(),
                'head_id' => rand(1, 100),
                'position_id' => $positions->random(),
                'level' => 2,
                'employment_at' => $faker->dateTimeBetween('-2 years', '-1 week'),
                'phone' => $faker->uaPhoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'salary' => rand(1, 500) * 1000,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }
        Employee::insert($level2);

        $heads2 = collect($level2)->pluck('id');
        $level3 = [];
        for ($i = 0; $i < 10000; $i++) {
            $level3[] = [
                'name' => $faker->name(),
                'head_id' => rand(101, 3100),
                'position_id' => $positions->random(),
                'level' => 3,
                'employment_at' => $faker->dateTimeBetween('-2 years', '-1 week'),
                'phone' => $faker->uaPhoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'salary' => rand(1, 500) * 1000,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }
        $chunks = array_chunk($level3, 5000);
        foreach ($chunks as $chunk) {
            Employee::insert($chunk);
        }


        $level4 = [];
        for ($i = 0; $i < 15000; $i++) {
            $level4[] = [
                'name' => $faker->name(),
                'head_id' => rand(3101, 13100),
                'position_id' => $positions->random(),
                'level' => 4,
                'employment_at' => $faker->dateTimeBetween('-2 years', '-1 week'),
                'phone' => $faker->uaPhoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'salary' => rand(1, 500) * 1000,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }
        $chunks = array_chunk($level4, 5000);
        foreach ($chunks as $chunk) {
            Employee::insert($chunk);
        }

        $level5 = [];
        for ($i = 0; $i < 25000; $i++) {
            $level5[] = [
                'name' => $faker->name(),
                'head_id' => rand(13101, 28100),
                'position_id' => $positions->random(),
                'level' => 5,
                'employment_at' => $faker->dateTimeBetween('-2 years', '-1 week'),
                'phone' => $faker->uaPhoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'salary' => rand(1, 500) * 1000,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }
        $chunks = array_chunk($level5, 5000);
        foreach ($chunks as $chunk) {
            Employee::insert($chunk);
        }
    }
}
