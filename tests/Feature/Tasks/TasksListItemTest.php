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
            ->assertSet('task.completed', true)
            ->assertEmitted('taskUpdated', $task->id);

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
            ->assertSet('task.completed', false)
            ->assertEmitted('taskUpdated', $task->id);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => false
        ]);
    }

    public function test_list_item_task_can_be_deleted()
    {
        $task = Task::factory()
            ->ofUser($this->user)
            ->create();

        Livewire::test('components.tasks.task-list-item', ['task' => $task])
            ->call('delete')
            ->assertHasNoErrors()
            ->assertSet('task', null)
            ->assertEmitted('taskDeleted')
            ->assertDispatchedBrowserEvent('show-toast', ['text' => 'Task deleted']);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }

    public function test_has_refresh_tash_listener()
    {
        $task = Task::factory()->create();
        Livewire::actingAs($this->user)
            ->test('components.tasks.task-list-item', ['task' => $task])
            ->emit("refresh-task-item-{$task->id}");
    }
}
