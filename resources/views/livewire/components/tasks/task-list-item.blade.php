<div>
    @if (!is_null($task))
        <div class="shadow-lg card compact side bg-base-100 overflow-visible">
            <div class="flex-row items-center justify-between space-x-4 card-body">
                <div class="flex">
                    <span class="mx-4 label-text">{{ $displayName }}</span>
                    @if (!$task->completed)
                        @if ($task->IsPast)
                            <div class="badge badge-error">
                                Have you forgotten about me already? :(
                            </div>
                        @elseif($task->date_diff < 10)
                            <div class="badge badge-warning">
                                @if($task->date_diff === 0)
                                    Ends Today!
                                @else
                                    Only {{ $task->date_diff }} days left
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
                <div class="flex items-center space-x-2">
                    <label
                        @if ($task->completed)
                            data-tip="Mark as uncompleted"
                        @else
                            data-tip="Mark as completed"
                        @endif
                        class="cursor-pointer label tooltip"
                        >
                        <input type="checkbox" wire:loading.attr="disabled" wire:model="task.completed" class="checkbox checkbox-accent">
                    </label>
                    <button class="btn btn-sm btn-error" wire:loading.attr="disabled" wire:click="delete">
                        <x-heroicon-o-trash class="w-4 h-4"/>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
