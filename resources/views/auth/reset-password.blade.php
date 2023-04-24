<x-verify.layout>
    <form class="container mt-24 flex flex-col gap-14 max-w-sm" action="{{ route('password.reset', $token) }}"
        method="POST">
        @csrf
        <p class="text-center text-2xl font-black">{{ __('guest.Reset Password') }}</p>
        <div class="flex flex-col gap-6">
            <x-form.input name="password" label="New Password" placeholder="Enter new password" type="password" />
            <x-form.input name="password_confirmation" label="Repeat Password" placeholder="Repeat password"
                type="password" />
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
        </div>
        <x-form.button>
            {{ __('guest.Save Changes') }}
        </x-form.button>
    </form>
</x-verify.layout>
