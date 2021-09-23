@props(['id'])
<div id="{{ $id }}" class="modal" onclick="hideModal('{{ $id }}')">
    <div class="modal-box" onclick="preventClickPropagation(event)">
        {{ $slot }}
    </div>
</div>
