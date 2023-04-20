@props(['title', 'number', 'color', 'col' => 'col-span-1'])

<div class="bg-{{ $color }}-opacity-8 h-48 md:h-64 {{ $col }} md:col-span-1 rounded-2xl">
    <div class="text-center my-6 md:my-10">
        <img src="{{ asset('assets/images/' . $color . '-arrow.svg') }}" alt="{{ $color }}-arrow"
            class="w-24 h-16 md: mx-auto">
        <p class="mx-auto mt-4 md:mt-6 mb-4 md:text-xl font-medium">{{ $title }}</p>
        <p class="font-black md:text-4xl text-2xl text-my-{{ $color }}">{{ number_format($number) }}</p>
    </div>
</div>
