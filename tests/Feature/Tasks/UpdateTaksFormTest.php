<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateTaskFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create();
        $name = $this->faker->sentence(2);
        $description = $this->faker->paragraph(2);
        Livewire::actingAs($this->user)
            ->test('components.tasks.task-create-update-form', ['task' => $task])
            ->assertSet('name', $task->name)
            ->assertSet('description', $task->description)
            ->assertSet('completed', $task->completed)
            ->assertSet('end_date', $task->end_date->format('Y-m-d'))
            ->assertSet('task_id', $task->id)
            ->assertSeeHtml('wire:submit.prevent="update"')
            ->assertSeeHtml('wire:model="name"')
            ->assertSeeHtml('wire:model="description"')
            ->assertSeeHtml('wire:model="completed"')
            ->assertSeeHtml('wire:model="end_date"')
            ->set('name', $name)
            ->set('description', $description)
            ->set('completed', $this->faker->boolean)
            ->set('end_date', $this->faker->date)
            ->call('update')
            ->assertHasNoErrors()
            ->assertEmitted('taskUpdated', $task->id)
            ->assertDispatchedBrowserEvent('hide-modal')
            ->assertDispatchedBrowserEvent('show-toast');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $name,
            'description' => $description
        ]);
    }

    public function test_has_on_update_listener()
    {
        $task = Task::factory()->create();
        Livewire::actingAs($this->user)
            ->test('components.tasks.task-create-update-form', ['task' => $task])
            ->emit("set-task-on-update-form-{$task->id}");
    }
}
