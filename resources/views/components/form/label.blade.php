@props(['name', 'label' => $name])

<label class="px-1 text-md text-black font-bold" for="{{ $name }}">
    {{ __('guest.' . ucWords($label)) }}
</label>
