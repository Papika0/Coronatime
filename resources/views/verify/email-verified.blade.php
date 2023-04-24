<x-verify.verification text="Your account is confirmed, you can sign in">
    <a href="{{ route('login.show') }}"
        class="bg-green-500 text-white font-black rounded-lg py-3 px-36 hover:bg-green-600 mt-24">
        {{ __('guest.Sign in') }}
    </a>

</x-verify.verification>
