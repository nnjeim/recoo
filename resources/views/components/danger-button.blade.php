<button {{ $attributes->merge(['type' => 'submit', 'class' => 'form__btn_danger']) }}>
    {{ $slot }}
</button>
