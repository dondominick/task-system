<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "task_name" => "Sample Task Title",
            "description" => fake()->text(),
            "status" => "pending",
            "start_date" => fake()->date(),
            "end_date" => fake()->date(),
            'employee_assigned' => "",
        ];
    }
}
