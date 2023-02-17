<div class="flex flex-col xl:flex-row">
	<div class="grow-0 max-w-2xl pb-2 mb-4 border-b xl:border-l xl:border-b-0 border-gray-200 order-0 xl:order-2">
		<div class="xl:sticky xl:top-8">
			<x-form.tabs.vertical.navs :tabs="$tabs" :activeTab="$activeTab"/>
			@isset($infoTab)
				<div class="px-4 py-4 border-t-2 border-gray-200 mt-6">
					{{$infoTab}}
				</div>
			@endisset
		</div>
	</div>
	<div class="flex-1 basis-2/3 order-1 p-px mr-4">
		{{$slot}}
	</div>
</div>

