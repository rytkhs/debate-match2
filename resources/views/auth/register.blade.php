<x-guest-layout>
    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">{{ __('messages.create_account') }}</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('messages.name')" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('messages.email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('messages.password')" />

            <x-text-input id="password"
                class="block mt-1 w-full" type="password"
                name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('messages.confirm_password')" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <button class="bg-primary text-white py-2 px-4 rounded-md w-full hover:bg-primary-dark focus:outline-none focus:shadow-outline-gray active:bg-gray-800 mb-4">
                {{ __('messages.create') }}
            </button>
        </div>

        <div class="mt-4 text-center">
            {{ __('messages.already_have_account') }}
            <a href="{{ route('login') }}"
                class="text-gray-500 hover:text-gray-400">{{ __('messages.login') }}
            </a>
        </div>

        <div class="relative flex py-3 items-center">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-4 text-gray-500">{{ __('messages.or') }}</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <div class="mt-2 flex items-center justify-center">
            @if(config('services.google.client_id'))
            <a href="{{ route('auth.google') }}" class="flex items-center justify-center w-full py-2 border border-gray-300 rounded-md mb-2 hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google mr-2" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                </svg>
                {{ __('messages.google_login') }}
            </a>
            @endif
        </div>
    </form>
</x-guest-layout>
