<?php

namespace App\Http\Livewire\Components\Tasks;

use App\Models\Task;
use Livewire\Component;

class TaskCreateUpdateForm extends Component
{
    public $name;
    public $description;
    public $completed = false;
    public $end_date;
    public $task_id;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'completed' => 'boolean',
        'end_date' => 'required|date'
    ];

    public function mount(Task $task = null)
    {
        if ($task) {
            $this->task_id = $task->id;
            $this->name = $task->name;
            $this->description = $task->description;
            $this->completed = $task->completed;
            $this->end_date = $task->end_date;
        }
    }

    public function render()
    {
        $creating = is_null($this->task_id);
        $action = $creating ? 'create' : 'update';
        return view('livewire.components.tasks.task-create-update-form', [
            'creating' => $creating,
            'action' => $action
        ]);
    }

    public function create()
    {
        $attributes = $this->validate();
        $attributes['user_id'] = auth()->id();
        Task::create($attributes);
        $this->name = null;
        $this->description = null;
        $this->completed = false;
        $this->end_date = null;
        $this->emit('taskCreated');
        $this->dispatchBrowserEvent('hide-modal', ['id' => 'create-form-modal']);
        $this->dispatchBrowserEvent('show-toast', ['text' => 'Task correctly created!']);
    }

    public function update()
    {
        $attributes = $this->validate();
        $attributes['user_id'] = auth()->id();
        Task::findOrFail($this->task_id)->update($attributes);
        $this->emit('taskUpdated');
        $this->dispatchBrowserEvent('hide-modal', ['id' => 'update-form-modal']);
        $this->dispatchBrowserEvent('show-toast', ['text' => 'Task correctly updated!']);
    }
}
