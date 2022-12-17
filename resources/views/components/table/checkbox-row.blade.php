<div class="cursor-pointer text-black text-center"
     wire:click="toggleSelect({{ $record->id }})">
    @if (! $record->selected)
        <x-micon.check_box_blank fill="currentColor" size="1.5rem" />
    @else
        <x-micon.check_box fill="currentColor" size="1.5rem" />
    @endif
</div>
