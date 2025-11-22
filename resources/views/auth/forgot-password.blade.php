<x-user-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Forgot Password') }}
        </h1>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse list-none px-0 *:mb-0">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">Home</a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Forgot
                            Password</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Please contact our support team using one of the methods below to reset your password.') }}
    </div>

    <!-- Tampilkan Kontak Support -->
    <div class="mt-6 space-y-4">
        @if ($setting->email)
            <div>
                <span class="font-semibold">{{ __('Email') }}:</span>
                <a href="mailto:{{ $setting->email }}" class="text-blue-500 hover:text-blue-700">
                    {{ $setting->email }}
                </a>
            </div>
        @endif

        @if ($setting->phone)
            <div>
                <span class="font-semibold">{{ __('Phone') }}:</span>
                <a href="tel:{{ $setting->phone }}" class="text-blue-500 hover:text-blue-700">
                    {{ $setting->phone }}
                </a>
            </div>
        @endif

        @if ($setting->telegram)
            <div>
                <span class="font-semibold">{{ __('Telegram') }}:</span>
                <a href="https://t.me/{{ $setting->telegram }}" target="_blank"
                    class="text-blue-500 hover:text-blue-700">
                    {{ $setting->telegram }}
                </a>
            </div>
        @endif

        @if ($setting->whatsapp)
            <div>
                <span class="font-semibold">{{ __('WhatsApp') }}:</span>
                <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank"
                    class="text-blue-500 hover:text-blue-700">
                    {{ $setting->whatsapp }}
                </a>
            </div>
        @endif
    </div>

    <!-- Pesan Tambahan -->
    <div class="mt-6 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Our support team will assist you in resetting your password.') }}
    </div>
</x-user-layout>
