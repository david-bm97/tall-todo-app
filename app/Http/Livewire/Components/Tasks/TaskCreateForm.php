<?php

namespace App\Http\Livewire\Components\Tasks;

use App\Models\Task;
use Livewire\Component;

class TaskCreateForm extends Component
{
    public $name;
    public $description;
    public $completed = false;
    public $end_date;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'completed' => 'boolean',
        'end_date' => 'required|date'
    ];

    public function render()
    {
        return view('livewire.components.tasks.task-create-form');
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
}
