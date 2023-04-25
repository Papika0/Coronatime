<x-layout>
    <div class="container md:mx-auto flex flex-col md:items-center px-4 h-screen">
        <header class="md:mt-20 mt-6 mb-11">
            <a href="{{ route('home.index') }}">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="md:w-44 md:h-12 w-36 h-9">
            </a>
        </header>
        {{ $slot }}
    </div>
</x-layout>
