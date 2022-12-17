<div x-data="{show: @entangle('show'), message: @entangle('message'), status: @entangle('status')}"
     class="w-full mb-1"
     x-bind:class="{
            	'bg-status-success': status === 'success',
            	'bg-gold-light': status === 'warning',
            	'bg-status-error': status === 'danger'
			}"
     style="display: none;"
     x-show="show">
    <div class="w-full mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="flex-1 flex items-center">
                <span class="flex text-black p-2">
					@if($status === 'success')
                        <x-micon.check_circle size="1.125rem"/>
                    @else
                        <x-micon.error_outline size="1.125rem"/>
                    @endif
                </span>
                <span class="ml-3 font-medium text-sm text-black truncate" x-html="message"></span>
            </div>

            <div class="flex-shrink-0">
                <button
                    type="button"
                    class="text-black -mr-1 flex p-2 focus:outline-none sm:-mr-2 transition"
                    aria-label="Dismiss"
                    x-on:click="show = false; $wire.close()">
                    <x-micon.close title="{{ __('generic.close') }}" size="1.125rem"/>
                </button>
            </div>
        </div>
    </div>
</div>
