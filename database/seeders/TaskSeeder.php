<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure we have a user first
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
        
        // Create sample tasks
        $tasks = [
            [
                'title' => 'Complete project proposal',
                'description' => 'Finish the project proposal for the client meeting',
                'date' => Carbon::now()->addDays(2),
                'priority' => 'high',
                'status' => 'pending',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Weekly team meeting',
                'description' => 'Discuss project progress and upcoming tasks',
                'date' => Carbon::now()->addDays(1),
                'priority' => 'medium',
                'status' => 'pending',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Research market trends',
                'description' => 'Research latest market trends for the quarterly report',
                'date' => Carbon::now()->addDays(5),
                'priority' => 'low',
                'status' => 'pending',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Prepare presentation',
                'description' => 'Create slides for the board meeting',
                'date' => Carbon::now()->addDays(3),
                'priority' => 'high',
                'status' => 'in-progress',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Update client documentation',
                'description' => 'Update user manual with new features',
                'date' => Carbon::now()->addDay(),
                'priority' => 'medium',
                'status' => 'completed',
                'user_id' => $user->id,
            ],
        ];
        
        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
} 