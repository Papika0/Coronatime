@props(['page'])

<x-layout>
    <header class="container mx-auto mt-5 mb-5 flex flex-row justify-between">
        <a href="{{ route('home.index') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="md:w-44 md:h-12">
        </a>

        <div class="flex flex-row gap-3 my-auto">
            <select name="language" id="language" class="bg-transparent border-none outline-none"
                onchange="location = this.value;">
                <option value="" selected disabled hidden>
                    @if (app()->getLocale() == 'en')
                        {{ __('dashboard.english') }}
                    @else
                        {{ __('dashboard.georgian') }}
                    @endif
                </option>
                <option value="{{ route('set.locale', 'en') }}">{{ __('dashboard.english') }}</option>
                <option value="{{ route('set.locale', 'ka') }}">{{ __('dashboard.georgian') }}</option>
            </select>
            <p class="font-bold border-r border-gray-400 px-3"> {{ ucWords(Auth::user()->username) }} </p>
            <a href="{{ route('logout') }}" class="hover:text-gray-700">
                <p> {{ __('dashboard.log out') }} </p>
            </a>
        </div>

    </header>
    <hr class="mb-10 border border-solid border-gray-100 ">
    <div class="container mx-auto">
        <p class="text-2xl font-extrabold"> {{ __("dashboard.$page") }} </p>

        <div class="mt-10 mb-4 relative">
            <a href="{{ route('dashboard.show') }}"
                class="{{ request()->routeIs('dashboard.show') ? ' border-b-2 border-black absolute bottom-0 left-0 font-bold' : '' }} inline-block pb-4">
                {{ __('dashboard.worldwide') }} </a>
            <a href="{{ route('countries.index') }}"
                class="{{ request()->routeIs('countries.index') ? 'border-b-2 border-black absolute bottom-0 left-0 font-bold' : '' }} inline-block pb-4 ml-40">
                {{ __('dashboard.by country') }}</a>
            <hr class="border border-solid border-gray-100">
        </div>
        {{ $slot }}
    </div>
</x-layout>
