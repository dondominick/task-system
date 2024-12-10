<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function createAdmin()
    {
        return $this->state(
            ["status" => "admin"]
        )->afterCreating(function (User $user) {
            Admin::factory()->create([
                "name" => $user->name,
                "email" => $user->email,
                "user_id" => $user->id,
            ]);
        });
    }
    public function createEmployer()
    {
        return $this->state(
            ["status" => "user"]
        )->afterCreating(function (User $user) {

            Employee::factory()->create([
                "firstname" => "Patricia Marie",
                "lastname" => "Cabelin",
                "email" => $user->email,
                "user_id" => $user->id,
                "department_id" => 1
            ]);
        });
    }
}
