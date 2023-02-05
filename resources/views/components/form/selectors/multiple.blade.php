@props([
	'id' => 'multi-select',
	'options' => '',
	'placeholder' => '',
	'search' => false,
	'optionValue' => 'id',
	'optionName' => 'name',
	'onSelectClose' => true,
	'onSelectEvent' => '',
	'onDeselectEvent' => '',
	'clearEvent' => '',
    'searchPlaceholder' => '',
	'showSelected' => false,
])

<div {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'w-full relative']) }}
	 x-data="{
	 	clear() {
	 		this.values = JSON.parse(this.oldValues);
			this.filteredOptions.forEach((o) => o.selected = false);
			this.open = false;
			this.searchText = '';
	 	},
	 	deselectOption(value, index) {
	 		this.values.splice(index, 1);

			if (this.filteredOptions.length > 0) {
				const optionIndex = this.filteredOptions.findIndex((v) => v[this.optionValue]?.toString() === value[this.optionValue]?.toString());

				if (optionIndex >= 0) {
					this.filteredOptions[optionIndex].selected = false;
				}
			}

			/* on deselect event */
			if (this.onDeselectEvent) {
				$wire.emit(this.onDeselectEvent, value[this.optionValue]);
			}
	 	},
	 	values: @entangle($attributes->wire('model')),
	 	oldValues: '',
	 	options: @entangle($options),
	 	filteredOptions: [],
	 	optionValue: @js($optionValue),
	 	optionName: @js($optionName),
	 	search: @js($search),
	 	searchText: '',
	 	selectOption(option) {
	 		/* on select */
			if (!option.selected) {
				obj = {};
				obj[this.optionValue] = option[this.optionValue];
				obj[this.optionName] = option[this.optionName];
				this.values.push(obj);

				/* on select event */
				if (this.onSelectEvent) {
					$wire.emit(this.onSelectEvent, option[this.optionValue]);
				}
			}
			/* on deselect */
			if (option.selected) {
				const valueIndex = this.values.findIndex((v) => v[this.optionValue]?.toString() === option[this.optionValue]?.toString());
				this.values.splice(valueIndex, 1);
				/* on deselect event */
				if (this.onDeselectEvent) {
					$wire.emit(this.onDeselectEvent, option[this.optionValue]);
				}
			}

			/* toggle selected */
			option.selected = !option.selected;

			/* close on select */
			if (this.onSelectClose) {
				open = false;
			}
	 	},
	 	open: false,
	 	onSelectEvent: @js($onSelectEvent),
	 	onDeselectEvent: @js($onDeselectEvent),
	 	clearEvent: @js($clearEvent),
	 	showSelected: @js($showSelected),
	 	onSelectClose: @js($onSelectClose),
	 }"
	 x-init="() => {
	 	oldValues = JSON.stringify(values);

		filteredOptions = options.map((option) => {
			option.selected = values.findIndex((val) => val[optionValue]?.toString() === option[optionValue]?.toString()) >= 0;
			return option;
		});

		$watch('open', (val) => {
			$nextTick(() => {
				if (val) {
					if (search) {
						/* Focus on search input on open. */
						$refs.search_input.focus();
					} else {
						/* Focus on the 1st option. */
						$refs.options.querySelector('[tabindex=\'0\']')?.focus();
					}
				} else {
					/* Focus on trigger on close. */
					if (showSelected) {
						$refs.trigger_show_selected.focus();
					} else {
						$refs.trigger_not_show_selected.focus();
					}
				}
			});
		});

		/* events */
		if (search) {
			/* filter search */
			$watch('searchText', (val) => {
				filteredOptions = options.filter((o) => o[optionName].toLowerCase().search(val.toLowerCase()) >= 0);
			});
		}
	 }"
	 x-trap="open"
	 @keyup.esc="open = false"
>
	<div class="relative w-full">
		<!-- This input is only used to toggle the dropdown when paired with a label. -->
		<div class="form__multiselect" @click="open = ! open">
			<input
				type="text"
				id="{{ $id }}"
				class="hidden"
				readonly
				autocomplete="off"
			/>

			<!-- trigger -->
			<template x-if="showSelected">
				<div
					class="flex items-center flex-wrap gap-2 mb-0"
					tabindex="0"
					x-ref="trigger_show_selected"
					@click="open = ! open"
					@keyup.enter="open = ! open"
				>
					<template x-for="(value, index) in values" :key="index">
						<div class="flex items-center rounded-full py-1 px-2 bg-gray-300">
							<span class="text-sm whitespace-nowrap mr-1" x-text="value[optionName]"></span>
							<x-micon.close
								class="flex items-center cursor-pointer justify-center bg-gray-300 rounded-full hover:text-white hover:bg-red-500 h-4 w-4"
								size="1rem"
								tabindex="0"
								@click.stop="deselectOption(value, index)"
								@keyup.enter.stop="deselectOption(value, index)"
							/>
						</div>
					</template>
				</div>
			</template>
			<template x-if="!showSelected">
				<div
					class="flex items-center flex-wrap gap-2 mb-0"
					tabindex="0"
					x-ref="trigger_not_show_selected"
					@click="open = ! open"
					@keyup.enter="open = ! open"
				>
					<span x-text="`${values.length} selected`"></span>
				</div>
			</template>
			<div class="border border-gray-300 border-l-0 rounded-sm bg-white absolute right-0 top-0 bottom-0 flex items-center">
				<div
					class="items-center cursor-pointer flex h-full mr-1 pl-2"
					@click="open = ! open"
				>
					<template x-if="!open">
						<x-micon.arrow_drop_down/>
					</template>
					<template x-if="open">
						<x-micon.arrow_drop_up/>
					</template>
				</div>
			</div>
		</div>
		<div x-show="open"
			 x-transition:enter="transition ease-out duration-200"
			 x-transition:enter-start="transform opacity-0 scale-95"
			 x-transition:enter-end="transform opacity-100 scale-100"
			 x-transition:leave="transition ease-in duration-75"
			 x-transition:leave-start="transform opacity-100 scale-100"
			 x-transition:leave-end="transform opacity-0 scale-95"
			 class="form__multiselect_dropdown"
			 style="display: none;"
			 @click.away="open = false">
			<!-- content -->
			<div class="flex flex-col w-full shadow-sm">
				<!-- search -->
				<template x-if="search">
					<div class="relative w-full p-2">
						<label for="{{ $id }}-search" class="sr-only">{{ $searchPlaceholder }}</label>
						<x-form.input
							id="{{ $id }}-search"
							x-ref="search_input"
							type="text"
							class="m-0 block w-full"
							placeholder="{{ $searchPlaceholder }}"
							x-model.debounce.500ms="searchText"
							autocomplete="{{ '-search-' . uniqid() }}"
							style="border-radius: 0;"
							@keydown.enter.prevent=""
						/>
						<div
							class="cursor-pointer absolute right-3 top-0 bottom-0 flex items-center justify-center">
							<x-micon.close
								class="text-black/30 hover:text-gray transition"
								title="{{ __('generic.clear') }}"
								tabindex="0"
								@click="searchText = ''"
								@keyup.enter="searchText = ''"
							/>
						</div>
					</div>
				</template>
				<!-- options -->
				<div class="max-h-48 overflow-y-auto" x-ref="options">
					<template x-for="(option, index) in filteredOptions" :key="option[optionValue]">
						<div
							class="dropdown_element"
							tabindex="0"
							@click="selectOption(option)"
							@keyup.enter="selectOption(option)"
						>
							<span x-text="option[optionName]"></span>
							<span x-show="option.selected">
								<x-micon.done class="text-status-success"/>
							</span>
						</div>
					</template>
				</div>
			</div>
		</div>
	</div>
</div>
