@props(['text'])
<x-verify.layout>
    <div class=" mt-64">
        <img src="{{ asset('assets/images/checkmark.gif') }}" alt="Checkmark" class="md:w-14 md:h-14 mx-auto">
        <p class="text-lg"> {{ __("guest.$text") }}</p>
    </div>
    {{ $slot }}
</x-verify.layout>
