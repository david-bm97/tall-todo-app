<?php

namespace App\Http\Livewire\Pages\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class TasksListPage extends Component
{
    use WithPagination;

    public function render()
    {
        $tasks = auth()->user()
            ->tasks()
            ->orderByNear()
            ->paginate(10);

        return view('livewire.pages.tasks.tasks-list-page', [
            'tasks' => $tasks
        ]);
    }
}
