<x-layout>
    <div class="container mx-auto flex flex-col items-center">
        <header class="mt-20">
            <a href="{{ route('home.index') }}">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="md:w-44 md:h-12">
            </a>
        </header>
        {{ $slot }}
    </div>
</x-layout>
