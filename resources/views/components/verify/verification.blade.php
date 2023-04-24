@props(['text'])
<x-verify.layout>

    <div class="flex flex-col h-full justify-between md:justify-center my-auto mt-56 md:mt-0 pb-10">
        <div class="">
            <img src="{{ asset('assets/images/checkmark.gif') }}" alt="Checkmark" class="md:w-14 md:h-14 mx-auto">
            <p class="text-lg text-center"> {{ __("guest.$text") }}</p>
        </div>
        {{ $slot }}
    </div>
</x-verify.layout>
