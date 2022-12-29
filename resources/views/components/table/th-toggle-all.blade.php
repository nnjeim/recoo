@props([
	'checked' => false,
	'toggleOff' => 'unselectAllRecords',
	'toggleOn' => 'selectPageRecords',
])
<x-table.th align="center" class="w-11">
    @if ($checked)
        <x-micon.check_box_intermediate class="cursor-pointer" wire:click="{{ $toggleOff }}"/>
    @else
        <x-micon.check_box_blank class="cursor-pointer" wire:click="{{ $toggleOn }}"/>
    @endif
</x-table.th>
