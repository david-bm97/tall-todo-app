<div>
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
            <label
                @if ($task->completed)
                    data-tip="Mark as uncompleted"
                @else
                    data-tip="Mark as completed"
                @endif
                class="cursor-pointer label tooltip">
                <input type="checkbox" wire:loading.attr="disabled" wire:model="task.completed" class="checkbox checkbox-accent">
            </label>
        </div>
    </div>
</div>
