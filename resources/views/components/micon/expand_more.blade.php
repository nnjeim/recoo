@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
    <svg class="micon" xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" viewBox="0 0 24 24" width="{{ $size }}" fill="currentColor">
        <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
        <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/>
    </svg>
</i>
