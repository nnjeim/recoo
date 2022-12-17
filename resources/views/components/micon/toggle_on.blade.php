@props(['fill' => '#f0b71c', 'height' => '1.25rem', 'width' => '2.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
    <svg class="micon" xmlns="http://www.w3.org/2000/svg" height="{{ $height }}" viewBox="0 0 40 20" width="{{ $width }}">
        <g fill="none" fill-rule="evenodd" transform="translate(-2 -2)">
            <path d="m0 0h44v24h-44z" />
            <path d="m32 2h-20c-5.52 0-10 4.48-10 10s4.48 10 10 10h20c5.52 0 10-4.48 10-10s-4.48-10-10-10zm0 16c-3.32 0-6-2.68-6-6s2.68-6 6-6 6 2.68 6 6-2.68 6-6 6z"
                fill="{{ $fill }}" />
        </g>
    </svg>
</i>
