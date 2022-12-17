<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button button-primary']) }}>
    {{ $slot }}
</button>
