<div>
    <form wire:submit.prevent="{{ $action }}" class="flex flex-col space-y-2">
        <x-form.input wireModel="name" label="Name" />
        <x-form.input wireModel="description" label="Description" />
        <x-form.input type="date" wireModel="end_date" label="End date" />
        <x-form.checkbox wireModel="completed" label="Completed" />
        <div>
            <button class="mt-6 btn btn-accent">
                @if ($creating)
                    Create
                @else
                    Update
                @endif
            </button>
        </div>
    </form>
</div>
