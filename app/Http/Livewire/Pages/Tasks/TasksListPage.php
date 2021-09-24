<?php

namespace App\Http\Livewire\Pages\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class TasksListPage extends Component
{
    use WithPagination;

    protected $listeners = [
        'taskDeleted' => 'refreshTasks',
        'taskCreated' => 'refreshTasks',
        'taskUpdated' => 'refreshTasks',
    ];

    public function render()
    {
        $tasks = $this->refreshTasks();
        return view('livewire.pages.tasks.tasks-list-page', [
            'tasks' => $tasks
        ]);
    }

    public function refreshTasks()
    {
        return auth()->user()
            ->tasks()
            ->orderByNear()
            ->paginate(10);
    }
}
