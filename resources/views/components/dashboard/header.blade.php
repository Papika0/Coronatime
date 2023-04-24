@props(['page'])

<x-layout>

    <header class="container mx-auto md:mt-5 mb-5 flex flex-row justify-between mt-2 px-4 pt-4 md:p-0">
        <a href="{{ route('home.index') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="md:w-44 md:h-12">
        </a>

        <div class="flex flex-row justify-end md:justify-start items-center gap-3">
            <x-dashboard.language-select />
            <div class="hidden md:flex md:gap-3">
                <p class="font-bold border-r border-gray-400 px-3">{{ ucWords(Auth::user()->username) }}</p>
                <a href="{{ route('logout') }}" class="hover:text-gray-700">
                    <p>{{ __('dashboard.log out') }}</p>
                </a>
            </div>

            <div x-data="{ isOpen: false }" class="relative">
                <button @click="isOpen = !isOpen"
                    class="flex items-center justify-center w-8 h-8 focus:outline-none md:hidden">
                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>{{ __('Open menu') }}</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>

                <div x-show="isOpen" @click.away="isOpen = false"
                    class="absolute z-50 right-0 mt-2 w-24 bg-white rounded-lg shadow-lg md:hidden">
                    <div class="py-1">
                        <p class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            {{ ucWords(Auth::user()->username) }}</p>
                        <a href="{{ route('logout') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('dashboard.log out') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <hr class="md:mb-10 mb-6 border border-solid border-gray-100 ">
    <div class="container mx-auto">

        <p class="text-2xl font-extrabold pl-4 md:pl-0"> {{ __("dashboard.$page") }} </p>

        <div class="md:mt-10 mt-6 mb-4 relative ml-4 md:ml-0">
            <a href="{{ route('dashboard.show') }}"
                class="{{ request()->routeIs('dashboard.show') ? ' border-b-2 border-black absolute bottom-0 left-0 font-bold' : '' }} inline-block pb-4">
                {{ __('dashboard.worldwide') }} </a>
            <a href="{{ route('countries.index') }}"
                class="{{ request()->routeIs('countries.index') ? 'border-b-2 border-black absolute bottom-0 left-0 font-bold' : '' }} inline-block pb-4 md:ml-40 ml-28">
                {{ __('dashboard.by country') }}</a>
            <hr class="border border-solid border-gray-100">
        </div>

        {{ $slot }}
    </div>

</x-layout>
