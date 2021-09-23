@props(['label' => null, 'wireModel' => null, 'type' => 'text'])
<div class="form-control">
    @if ($label)
        <label class="label">
            <span class="label-text">{{ $label }}</span>
        </label>
    @endif
    <input type="{{ $type }}" placeholder="{{ $label }}" wire:model="{{ $wireModel }}" class="input @error($wireModel) input-error @enderror input-bordered">
    @error($wireModel)
        <div class="alert alert-error">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>{{ $message }}</label>
            </div>
        </div>
    @enderror
</div>