<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTaskFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_create_task()
    {
        $name = $this->faker->sentence(4);
        $description = $this->faker->paragraph;
        Livewire::actingAs($this->user)
            ->test('components.tasks.task-create-form')
            ->assertSeeHtml('wire:submit.prevent="create"')
            ->assertSeeHtml('wire:model="name"')
            ->assertSeeHtml('wire:model="description"')
            ->assertSeeHtml('wire:model="completed"')
            ->assertSeeHtml('wire:model="end_date"')
            ->set('name', $name)
            ->set('description', $description)
            ->set('completed', $this->faker->boolean)
            ->set('end_date', $this->faker->date)
            ->call('create')
            ->assertHasNoErrors()
            ->assertEmitted('taskCreated')
            ->assertDispatchedBrowserEvent('hide-modal')
            ->assertDispatchedBrowserEvent('show-toast')
            ->assertSet('name', null)
            ->assertSet('description', null)
            ->assertSet('completed', false)
            ->assertSet('end_date', null);
        $this->assertDatabaseHas('tasks', [
            'name' => $name,
            'description' => $description
        ]);
    }
}
