<x-verify.layout>
    <form class="container md:mt-40 flex flex-col md:gap-14 max-w-sm h-full" action="{{ route('password.request') }}"
        method="POST">
        @csrf
        <p class="text-center md:text-2xl text-xl font-black mb-10 md:m-0">{{ __('guest.Reset Password') }}</p>
        <div class="flex flex-col justify-between h-full pb-10 md:p-0 md:flex-none md:justify-normal md:gap-14">
            <x-form.input name="email" label="Email" placeholder="Enter your email" />

            <x-form.button>
                {{ __('guest.Reset Password') }}
            </x-form.button>
        </div>
    </form>
</x-verify.layout>
