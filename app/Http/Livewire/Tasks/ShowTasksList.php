<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTasksList extends Component
{
    use WithPagination;

    public function render()
    {
        $tasks = auth()->user()
            ->tasks()
            ->orderByNear()
            ->paginate(10);
        
        return view('livewire.tasks.show-tasks-list', [
            'tasks' => $tasks
        ]);
    }
}
