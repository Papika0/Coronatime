@props(['name', 'label' => $name])

<label class="px-1 text-md text-black font-bold" for="{{ $name }}">
    {{ ucwords($label) }}
</label>
