<x-verify.layout>
    <form class="container mt-40 flex flex-col gap-14 max-w-sm" action="{{ route('password.request') }}" method="POST">
        @csrf
        <p class="text-center text-2xl font-black">Reset Password</p>
        <x-form.input name="email" label="Email" placeholder="Enter your email" />
        <x-form.button>
            RESET PASSWORD
        </x-form.button>
    </form>
</x-verify.layout>