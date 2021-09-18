<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksOrderByNearTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_ordered_by_near_works()
    {
        $nearest = Task::factory()
            ->withEndDate(now()->subDay())
            ->create();
        Task::factory()
            ->withEndDate(now()->subWeek())
            ->create();

        $tasks = Task::orderByNear()->get();
        $this->assertEquals($nearest->id, $tasks->first()->id);
    }
}
