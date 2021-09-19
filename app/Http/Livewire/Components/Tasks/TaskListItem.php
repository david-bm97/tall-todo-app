<?php

namespace App\Http\Livewire\Components\Tasks;

use App\Models\Task;
use Livewire\Component;

class TaskListItem extends Component
{
    public $task;
    public $displayName;

    protected $rules = [
        'task.completed' => 'required|boolean'
    ];

    public function updatedTaskCompleted($value, $updatedKey)
    {
        $this->task->save();
    }

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->displayName = $task->name;
        if ($task->end_date) {
            $this->displayName .= " ({$task->end_date->format('d-m-Y')})";
        }
    }

    public function render()
    {
        return view('livewire.components.tasks.task-list-item');
    }

    public function delete()
    {
        $this->task->delete();
        $this->task = null;
        $this->emit('taskDeleted');
        $this->dispatchBrowserEvent('show-toast', ['text' => 'Task deleted']);
    }
}
