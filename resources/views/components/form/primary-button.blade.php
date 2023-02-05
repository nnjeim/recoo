<button {{ $attributes->merge(['type' => 'submit', 'class' => 'form__btn_primary']) }}>
    {{ $slot }}
</button>
