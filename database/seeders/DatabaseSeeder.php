<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //   User::factory(10)->createEmployer()->create();
        // User::factory()->create([
        //     "status" => "user"
        // ]);
        //   Department::factory(5)->create();
        // Task::factory()
        //     ->count(10)
        //     ->state(new Sequence(
        //         ["employee_assigned" => "everyone"],
        //         ["employee_assigned" => 2],
        //         ["employee_assigned" => 3],

        //     ))
        //     ->create();
        User::factory()->createAdmin()->create();
    }
}
