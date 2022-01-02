<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $positions = Position::pluck('id');

        return [
            'name' => $this->faker->name(),
            'position_id' => $positions->random(),
            'employment_at' => $this->faker->dateTimeBetween('-2 years', '-1 week'),
            'phone' => $this->faker->uaPhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'salary' => rand(1, 500) * 1000,
        ];
    }
}
