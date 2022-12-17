<div class="flex flex-col xl:flex-row">
	<div class="grow-0 max-w-2xl pb-2 mb-4 border-b xl:border-l xl:border-b-0 border-gray-200 order-0 xl:order-2">
		<x-form.tabs.vertical.navs :tabs="$tabs" :activeTab="$activeTab"/>
	</div>
	<div class="flex-1 basis-2/3 order-1 p-px mr-7.5">
		{{$slot}}
	</div>
</div>
