@props(['type' => ''])


@if ($type === 'bold')
    <h1 class="text-2xl font-black mb-4">
        {{ __("guest.$slot") }}
    </h1>
@else
    <h1 class="text-xl font-normal text-gray-450 mb-6">
        {{ __("guest.$slot") }}
    </h1>
@endif
