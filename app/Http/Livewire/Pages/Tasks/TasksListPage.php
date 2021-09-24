<?php

namespace App\Http\Livewire\Pages\Tasks;

use Livewire\Component;
use Livewire\WithPagination;

class TasksListPage extends Component
{
    use WithPagination;

    protected $listeners = [
        'taskDeleted' => 'refreshTasks',
        'taskCreated' => 'refreshTasks',
        'taskUpdated' => 'onTaskUpdated',
    ];

    public function render()
    {
        $tasks = $this->refreshTasks();
        return view('livewire.pages.tasks.tasks-list-page', [
            'tasks' => $tasks
        ]);
    }

    public function onTaskUpdated($task_id)
    {
        $this->emit("refresh-task-item-{$task_id}");
        $this->emit("set-task-on-update-form-{$task_id}");
    }

    public function refreshTasks()
    {
        return auth()->user()
            ->tasks()
            ->orderByNear()
            ->paginate(10);
    }
}
