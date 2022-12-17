@if (is_array(session('banner')) && !empty(session('banner')))
@foreach (session('banner') as $key => $props)
    <livewire:notification.banner :_key="$key"
                                :_props="$props"
                                :key="$key"/>
@endforeach
@endif
