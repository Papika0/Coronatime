@props(['title', 'number', 'color', 'col' => 'col-span-1', 'text', 'background'])


<div class="{{ $background }} h-48 md:h-64 {{ $col }} md:col-span-1 rounded-2xl">
    <div class="text-center my-6 md:my-10">
        <img src="{{ asset('assets/images/' . $color . '-arrow.svg') }}" alt="{{ $color }}-arrow"
            class="w-24 h-16 md: mx-auto">
        <p class="mx-auto mt-4 md:mt-6 mb-4 md:text-xl font-medium">{{ __("dashboard.$title") }}</p>
        <p class="font-black md:text-4xl text-2xl {{ $text }}">{{ number_format($number) }}</p>
    </div>
</div>
