<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TasksListItemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_list_item_task_contains_task_data()
    {
        $task = Task::factory()->ofUser($this->user)->create();
        Livewire::test('components.tasks.task-list-item', ['task' => $task])
            ->assertSee($task->name);
    }

    public function test_list_item_task_can_mark_completed()
    {
        $task = Task::factory()
            ->ofUser($this->user)
            ->uncompleted()
            ->create();

        Livewire::test('components.tasks.task-list-item', ['task' => $task])
            ->set('task.completed', true)
            ->assertSet('task.completed', true);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true
        ]);
    }

    public function test_list_item_task_can_unmark_completed()
    {
        $task = Task::factory()
            ->ofUser($this->user)
            ->completed()
            ->create();

        Livewire::test('components.tasks.task-list-item', ['task' => $task])
            ->set('task.completed', false)
            ->assertSet('task.completed', false);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => false
        ]);
    }
}
