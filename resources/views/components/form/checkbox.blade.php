@props(['label' => null, 'wireModel' => null])
<div class="px-4 card bordered">
    <div class="form-control">
        <label class="cursor-pointer label">
            <span class="label-text">{{ $label }}</span>
            <input type="checkbox" class="checkbox" wire:model="{{ $wireModel }}">
        </label>
    </div>
</div>
