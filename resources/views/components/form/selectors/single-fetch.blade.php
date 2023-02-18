@props([
	'clearEvent' => '',
    'disabled' => false,
	'id' => 'multi-select',
	'method' => '',
	'placeholder' => '',
	'oldName' => null,
	'oldValue' => null,
	'onSelectClose' => true,
	'onSelectEvent' => '',
	'options' => 'options',
	'optionValue' => 'id',
	'optionName' => 'name',
	'revertToOldStateOnClear' => false,
	'searchPlaceholder' => '',
	'showClearButton' => true,
	'isInvalid' => false,
])

<div {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'w-full relative']) }}
	 x-data="{
	 	clear() {
			this.value = this.oldValue;
			this.name = this.oldName;
			this.open = false;
			this.searchText = '';
		},
		clearEvent: @js($clearEvent),
		disabled: @js($disabled),
		id: @js($id),
		name: '',
		oldName: @js($oldName),
		oldValue: @js($oldValue),
		onSelectClose: @js($onSelectClose),
		onSelectEvent: @js($onSelectEvent),
		open: false,
		optionName: @js($optionName),
		optionValue: @js($optionValue),
		options: @entangle($options).defer,
		revertToOldStateOnClear: @js($revertToOldStateOnClear),
		searchText: '',
		selectOption(option) {
			this.value = option[this.optionValue];
			this.name = option[this.optionName];
			if (this.onSelectClose) {
				this.open = false;
			}

			/* on click event */
			if (this.onSelectEvent) {
				$wire.emitSelf(this.onSelectEvent, option[this.optionValue]);
			}
		},
		showClearButton: @js($showClearButton),
		value: @entangle($attributes->wire('model')),
	 }"
	 x-init="() => {
		/* set initial name */
		const option = options.find((o) => o[optionValue]?.toString() === value?.toString());
		if (option) {
			name = option[optionName];
		}

		if (revertToOldStateOnClear) {
			oldName = name;
			oldValue = value;
		}

		/* events */
		if (clearEvent) {
			window.addEventListener(clearEvent, () => {
				name = '';
				searchText = '';
			});
		}
		/* focus search input */
		$watch('open', (val) => {
			$nextTick(() => {
				if (val) {
					/* Focus on search input on open. */
					$refs.search_input.focus();
				} else {
					/* Focus on trigger on close. */
					$refs.trigger.focus();
				}
			});
		});

		// If the value is changed from elsewhere, update the name accordingly.
		$watch('value', (val) => {
			const option = options.find((o) => o[optionValue]?.toString() === val?.toString());
			name = option ? option[optionName] : '';
		});

		/* filter search */
		$watch('searchText', (val) => {
			if (val !== '') {
				$wire.call('{{ $method }}', val);
			} else {
				$wire.set('{{ $options }}', []);
			}
		});
	 }"
	 x-trap="open"
	 @keyup.esc="open = false"
>
	<div class="relative w-full">
		<div>
			<!-- trigger -->
			<x-form.input
				type="text"
				id="{{ $id }}"
				class="cursor-pointer m-0 block w-full"
				placeholder="{{ $placeholder }}"
				x-bind:value="name"
				x-ref="trigger"
				readonly
				autocomplete="off"
				@click="open = ! open"
				@keydown.enter.prevent=""
				@keyup.enter.prevent="open = ! open"
				:disabled="$disabled"
				:isInvalid="$isInvalid"
				autocomplete="off"
			/>
		</div>
		<div x-show="open"
			 x-transition:enter="transition ease-out duration-200"
			 x-transition:enter-start="transform opacity-0 scale-95"
			 x-transition:enter-end="transform opacity-100 scale-100"
			 x-transition:leave="transition ease-in duration-75"
			 x-transition:leave-start="transform opacity-100 scale-100"
			 x-transition:leave-end="transform opacity-0 scale-95"
			 class="absolute z-50 mt-2 w-full shadow-lg origin-top-left left-0 bg-white"
			 style="display: none;"
			 @click.away="open = false">
			<!-- content -->
			<div class="ring-1 ring-black ring-opacity-5">
				<div class="flex flex-col w-full shadow-sm">
					<!-- search -->
					<div class="relative w-full">
						<label for="{{ $id }}-search" class="sr-only">{{ $searchPlaceholder }}</label>
						<x-form.input
							id="{{ $id }}-search"
							x-ref="search_input"
							type="text"
							class="m-0 block w-full"
							placeholder="{{ $searchPlaceholder }}"
							x-model.debounce.500ms="searchText"
							autocomplete="{{ $id . '-search-' . uniqid() }}"
							style="border-radius: 0;"
							@keydown.enter.prevent=""
							autocomplete="off"
						/>
						<div class="cursor-pointer absolute right-0 top-0 bottom-0 flex items-center justify-center">
							<x-micon.close
								class="text-gray-300"
								tabindex="0"
								@click="searchText = ''"
								@keyup.enter="searchText = ''"
								title="{{ __('generic.clear') }}"
							/>
						</div>
					</div>
					<!-- options -->
					<div class="max-h-48 overflow-y-auto">
						<template x-if="options">
							<template x-for="option in options" :key="option[optionValue]">
								<div
									class="flex justify-between cursor-pointer hover:bg-gray-200 hover:text-gray-500 px-2 py-2"
									tabindex="0"
									@click="selectOption(option)"
									@keyup.enter="selectOption(option)"
								>
									<span x-text="option[optionName]"></span>
									<span x-show="option[optionValue]?.toString() === value?.toString()">
										<x-micon.done class="text-status-success"/>
									</span>
								</div>
							</template>
						</template>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-white absolute right-0 top-0 bottom-0 flex items-center">
		<div
			class="items-center cursor-pointer border-t border-b border-gray-300 flex h-full mr-1 pl-2 text-gray-500"
			@click="open = ! open"
		>
			<template x-if="!open">
				<x-micon.arrow_drop_down/>
			</template>
			<template x-if="open">
				<x-micon.arrow_drop_up/>
			</template>
		</div>
		<template x-if="showClearButton && !disabled">
			<div class="cursor-pointer border border-gray-300 px-1 -mx-1 h-full flex items-center justify-center">
				<x-micon.close
					class="text-status-error"
					tabindex="0"
					@click="clear"
					@keyup.enter="clear"
					title="{{ __('generic.clear') }}"
				/>
			</div>
		</template>
	</div>
</div>
