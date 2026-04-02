<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Set up Laravel Cloud deployment',
                'description' => 'Configure cloud.yaml and environment variables for production deployment.',
                'status' => 'completed',
                'priority' => 'high',
                'due_date' => now()->addDays(1),
            ],
            [
                'title' => 'Design database schema',
                'description' => 'Create migrations for the task management system with proper indexes.',
                'status' => 'completed',
                'priority' => 'high',
                'due_date' => now()->subDays(2),
            ],
            [
                'title' => 'Add user authentication',
                'description' => 'Implement login and registration using Laravel Breeze or Fortify.',
                'status' => 'pending',
                'priority' => 'medium',
                'due_date' => now()->addDays(7),
            ],
            [
                'title' => 'Write API endpoints',
                'description' => 'Create RESTful API endpoints for tasks with proper validation.',
                'status' => 'in_progress',
                'priority' => 'medium',
                'due_date' => now()->addDays(5),
            ],
            [
                'title' => 'Add email notifications',
                'description' => 'Send notifications when tasks are due or overdue.',
                'status' => 'pending',
                'priority' => 'low',
                'due_date' => now()->addDays(14),
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
