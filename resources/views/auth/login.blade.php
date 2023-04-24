<x-login.layout>

    <x-form.header type='bold'>Welcome back</x-form.header>
    <x-form.header>Welcome back! Please enter your details</x-form.header>

    <form class="flex flex-col gap-6 max-w-sm" action="{{ route('login') }}" method="POST">
        @csrf
        <x-form.input name="email" label="Username" placeholder="Enter unique username or email" />
        <x-form.input name="password" type="password" label="Password" placeholder="Fill in password" />

        <div class="flex justify-between">
            <div class="flex">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm font-semibold">{{ __('guest.Remember this device') }}</label>
            </div>
            <a href="{{ route('password.request_show') }}"
                class="text-sm font-semibold text-my-blue hover:text-blue-800">{{ __('guest.Forgot password?') }}</a>
        </div>

        <x-form.button>
            {{ __('guest.Login') }}
        </x-form.button>
        <footer>
            <p class="text-sm text-center text-gray-450"> {{ __("guest.Don't have an account?") }} <a
                    href="{{ route('register.show') }}"
                    class="text-black font-bold hover:text-gray-700">{{ __('guest.Sign up for free') }}</a>
            </p>
        </footer>
    </form>

</x-login.layout>
