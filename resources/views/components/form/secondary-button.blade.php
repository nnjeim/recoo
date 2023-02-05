<button {{ $attributes->merge(['type' => 'button', 'class' => 'form__btn_transparent']) }}>
    {{ $slot }}
</button>
