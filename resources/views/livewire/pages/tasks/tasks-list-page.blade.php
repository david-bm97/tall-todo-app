<div class="container">
    <x-modal id="create-form-modal">
        @livewire('components.tasks.task-create-update-form')
    </x-modal>
    <div class="tooltip tooltip-right" data-tip="Create a new task">
        <button
            class="mb-2 btn btn-circle"
            onclick="showModal('create-form-modal')"
            >
            <x-heroicon-o-plus class="w-6 h-6"/>
        </button>
    </div>
    <div class="flex flex-col p-8 space-y-4 bg-base-200 rounded-box">
        @foreach ($tasks as $task)
            @livewire('components.tasks.task-list-item', ['task' => $task], key($task->id))
        @endforeach
    </div>
    <div class="my-4">
        {{ $tasks->links() }}
    </div>
</div>
