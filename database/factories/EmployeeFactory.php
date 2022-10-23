<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Department;
use App\Enums\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'department_id' => Department::pluck('id')[fake()->numberBetween(1, Department::count() - 1)],
            'user_id' => User::pluck('id')[fake()->numberBetween(1, User::count() - 1)],
            'status' =>  array_rand([
                EmployeeStatusEnum::ACTIVE->id(),
                EmployeeStatusEnum::BLOCKED->id(),
                EmployeeStatusEnum::INACTIVE->id()
            ]),
            'number' => fake()->randomNumber()
        ];
    }
}
