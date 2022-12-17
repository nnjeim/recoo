<div class="flex items-center justify-center rounded-full mr-4 p-2 cursor-pointer text-gray-400 hover:text-gray-500 hover:bg-gray-50"
     wire:click="toggleSelect({{ $record->id }})">
    @if (! $record->selected)
        <x-micon.radio_button_unchecked fill="currentColor"
                                 size="1.375rem" />
    @else
        <x-micon.radio_button_checked fill="currentColor"
                           size="1.375rem" />
    @endif
</div>
