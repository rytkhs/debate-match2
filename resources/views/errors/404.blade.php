<x-app-layout>
    <x-slot name="header">
        <x-header></x-header>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary-light text-primary mb-4">
                        <i class="fa-solid fa-map-signs text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('messages.error_404_title') }}</h1>
                    <p class="text-lg text-gray-600">{{ __('messages.error_404_message') }}</p>
                </div>
                <div class="text-center mt-8">
                    <p class="text-gray-600 mb-6">{{ __('messages.error_404_action') }}</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ url('/') }}" class="hero-button bg-primary text-white hover:bg-primary-dark">
                            <i class="fa-solid fa-home mr-2"></i>
                            {{ __('messages.back_to_home') }}
                        </a>
                        <a href="{{ route('rooms.index') }}" class="hero-button bg-white text-primary border-2 border-primary hover:bg-primary hover:text-white">
                            <i class="fa-solid fa-door-open mr-2"></i>
                            {{ __('messages.find_debate_room') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <x-footer></x-footer>
    </x-slot>
</x-app-layout>
