<x-login.layout>

    <x-form.header type='bold'>Welcome to Coronatime</x-form.header>
    <x-form.header>Please enter required info to sign up</x-form.header>

    <form class="flex flex-col gap-6 max-w-sm" action="{{ route('register') }}" method="POST">
        @csrf
        <x-form.input name="username" label="Username" placeholder="Enter unique username" bottom_label="true" />
        <x-form.input name="email" placeholder="Enter your email" />
        <x-form.input name="password" type="password" label="Password" placeholder="Fill in password" />
        <x-form.input name="password_confirmation" type="password" label="Repeat Password"
            placeholder="Repeat password" />

        <x-form.button>
            {{ __('guest.Sign up') }}
        </x-form.button>
        <footer>
            <p class="text-sm text-center text-gray-450">{{ __('guest.Already have an account') }} <a
                    href="{{ route('login.show') }}"
                    class="text-black font-bold hover:text-gray-700">{{ __('guest.Log in') }}</a></p>
        </footer>
    </form>

</x-login.layout>
