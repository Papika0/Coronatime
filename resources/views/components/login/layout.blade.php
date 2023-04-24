<x-layout>
    <header class="md:flex">
        <div class="md:mt-10 md:ml-5.5 md:w-3/5 px-3 my-6">
            <div class="flex flex-row justify-between">
                <a href="{{ route('home.index') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="md:w-44 md:h-12">
                </a>
                <x-dashboard.language-select />
            </div>
            <div class="mt-16">
                {{ $slot }}
            </div>
        </div>
        <div class="w-2/5 hidden md:block">
            <img src="{{ asset('assets/images/corona-main.svg') }}" alt="background"
                class="md:w-full md:h-screen md:object-cover">
        </div>
    </header>

</x-layout>
