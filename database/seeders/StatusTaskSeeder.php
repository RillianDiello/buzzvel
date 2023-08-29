<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TaskStatus::create(['name' => 'done', 'description' => 'Task completed']);
        TaskStatus::create(['name' => 'in progress', 'description' => 'Task in progress']);
        TaskStatus::create(['name' => 'waiting', 'description' => 'Waiting task']);
        TaskStatus::create(['name' => 'delete', 'description' => ' Task deleted']);
    }
}
