<x-layout>
    <div class="container mx-auto flex flex-col items-center">
        <header class="mt-20">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="md:w-44 md:h-12">
        </header>
        {{ $slot }}
    </div>
</x-layout>
