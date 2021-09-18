<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TasksListTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_contains_livewire_component()
    {
        $this->actingAs($this->user)
            ->get(route('tasks.list'))
            ->assertSeeLivewire('tasks.show-tasks-list');
    }

    public function test_contains_task_list_item()
    {
        $task = Task::factory()->ofUser($this->user)->create();
        Livewire::actingAs($this->user)
            ->test('tasks.show-tasks-list')
            ->assertSee($task->name);
    }
}
