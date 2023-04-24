<x-verify.verification text="Your password has been updated successfully">

    <a href="{{ route('login.show') }}"
        class="bg-green-500 text-white font-black rounded-lg py-3 text-center hover:bg-green-600 mt-24">
        {{ __('guest.Sign in') }}
    </a>


</x-verify.verification>
