<x-verify.layout>
    <form class="container md:mt-24 flex flex-col md:gap-14 max-w-sm h-full"
        action="{{ route('password.reset', $token) }}" method="POST">
        @csrf
        <p class="text-center md:text-2xl text-xl font-black mb-10 md:m-0">{{ __('guest.Reset Password') }}</p>
        <div class="flex flex-col justify-between h-full pb-10 md:p-0 md:flex-none md:justify-normal md:gap-14">
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
        </div>
    </form>
</x-verify.layout>
