<x-player-layout>
    <x-slot name="title">
        {{ $content->title }} - {{ $setting->site_name }}
    </x-slot>

    <x-slot name="meta">
        <!-- Meta Description -->
        <meta name="description" content="{{ $setting->site_description }}">

        <!-- Meta Keywords -->
        <meta name="keywords" content="{{ 'package, content, video, image' }}">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $content->title }} - {{ $setting->site_name }}">
        <meta property="og:description" content="{{ $setting->site_description }}">
        <meta property="og:image" content="{{ asset($content->thumbnail) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $content->title }} - {{ $setting->site_name }}">
        <meta property="twitter:description" content="{{ $setting->site_description }}">
        <meta property="twitter:image" content="{{ asset($content->thumbnail) }}">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "BreadcrumbList",
              "itemListElement": [
                {
                  "@type": "ListItem",
                  "position": 1,
                  "name": "Home",
                  "item": "{{ url('/') }}"
                },
                {
                  "@type": "ListItem",
                  "position": 2,
                  "name": "{{ $content->package->name }}",
                  "item": "{{ url('/' . $content->package->slug) }}"
                },
                {
                  "@type": "ListItem",
                  "position": 3,
                  "name": "{{ $content->title }}",
                  "item": "{{ url()->current() }}"
                }
              ]
            }
        </script>
    </x-slot>

    <div class="absolute top-0 left-0 w-full z-50">
        <div class="flex justify-between p-4 bg-black/60">
            <a href="{{ route('package', $content->package->slug) }}">
                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </a>
            {{-- @auth
                <div class="flex items-center text-white">
                    <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">

                        <defs>
                        </defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <circle cx="45.001" cy="47.211" r="42.791"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(232,129,2); fill-rule: nonzero; opacity: 1;"
                                transform="  matrix(1 0 0 1 0 0) " />
                            <circle cx="45" cy="42.79" r="35"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(243,158,9); fill-rule: nonzero; opacity: 1;"
                                transform="  matrix(1 0 0 1 0 0) " />
                            <path
                                d="M 45 13.791 c 17.977 0 32.78 13.555 34.766 31 c 0.15 -1.313 0.234 -2.647 0.234 -4 c 0 -19.33 -15.67 -35 -35 -35 s -35 15.67 -35 35 c 0 1.353 0.085 2.687 0.234 4 C 12.22 27.346 27.023 13.791 45 13.791 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(232,129,2); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 45 0 C 21.367 0 2.209 19.158 2.209 42.791 c 0 23.633 19.158 42.791 42.791 42.791 s 42.791 -19.158 42.791 -42.791 C 87.791 19.158 68.633 0 45 0 z M 45 75.928 c -18.301 0 -33.137 -14.836 -33.137 -33.137 C 11.863 24.49 26.699 9.653 45 9.653 S 78.137 24.49 78.137 42.791 C 78.137 61.092 63.301 75.928 45 75.928 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(254,236,154); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 45 0 C 21.367 0 2.209 19.158 2.209 42.791 c 0 23.633 19.158 42.791 42.791 42.791 s 42.791 -19.158 42.791 -42.791 C 87.791 19.158 68.633 0 45 0 z M 45 75.928 c -18.301 0 -33.137 -14.836 -33.137 -33.137 C 11.863 24.49 26.699 9.653 45 9.653 S 78.137 24.49 78.137 42.791 C 78.137 61.092 63.301 75.928 45 75.928 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(253,216,53); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 83.422 23.947 l -7.339 7.339 c 1.241 3.352 1.947 6.961 2.035 10.723 l 8.623 -8.623 C 85.999 30.079 84.88 26.916 83.422 23.947 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(254,236,154); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 44.218 75.909 c -3.762 -0.087 -7.371 -0.794 -10.723 -2.035 l -7.339 7.339 c 2.969 1.459 6.132 2.578 9.439 3.32 L 44.218 75.909 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(254,236,154); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 15.236 57.365 l -7.118 7.118 c 3.188 5.408 7.526 10.054 12.685 13.598 l 6.975 -6.975 C 22.396 67.826 18.027 63.053 15.236 57.365 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(254,236,154); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 66.692 5.909 l -7.118 7.118 c 5.688 2.791 10.461 7.16 13.741 12.541 l 6.975 -6.975 C 76.745 13.435 72.1 9.097 66.692 5.909 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(254,236,154); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 49.861 10.012 c 1.441 0.212 2.849 0.522 4.223 0.913 l 7.565 -7.565 c -1.224 -0.517 -2.478 -0.976 -3.756 -1.379 L 49.861 10.012 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(254,236,154); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 5.569 59.44 l 7.565 -7.565 c -0.391 -1.374 -0.701 -2.782 -0.913 -4.223 L 4.19 55.683 C 4.593 56.962 5.052 58.216 5.569 59.44 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(254,236,154); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 44.737 67.688 c -4.711 0 -9.153 -2.883 -10.902 -7.546 c -0.582 -1.552 0.204 -3.281 1.756 -3.862 c 1.549 -0.586 3.28 0.203 3.862 1.755 c 1.089 2.906 4.34 4.389 7.248 3.294 c 2.905 -1.09 4.384 -4.341 3.294 -7.248 c -0.624 -1.664 -1.967 -2.908 -3.685 -3.412 l -0.188 -0.062 l -4.224 -1.547 c -3.497 -1.06 -6.231 -3.618 -7.512 -7.033 c -1.091 -2.909 -0.983 -6.068 0.302 -8.896 c 1.285 -2.828 3.595 -4.986 6.504 -6.077 c 6.002 -2.25 12.72 0.801 14.972 6.806 c 0.582 1.551 -0.204 3.281 -1.755 3.863 c -1.547 0.579 -3.281 -0.203 -3.862 -1.755 c -1.09 -2.907 -4.341 -4.385 -7.249 -3.295 c -1.408 0.528 -2.526 1.573 -3.148 2.941 c -0.622 1.369 -0.674 2.898 -0.146 4.307 c 0.624 1.665 1.967 2.908 3.685 3.413 l 0.187 0.062 l 4.225 1.547 c 3.496 1.06 6.23 3.618 7.512 7.033 c 2.251 6.005 -0.803 12.722 -6.806 14.973 C 47.467 67.449 46.091 67.688 44.737 67.688 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(232,129,2); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 45 32.323 c -1.657 0 -3 -1.343 -3 -3 V 24.5 c 0 -1.657 1.343 -3 3 -3 c 1.657 0 3 1.343 3 3 v 4.823 C 48 30.979 46.657 32.323 45 32.323 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(232,129,2); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 45 72.5 c -1.657 0 -3 -1.343 -3 -3 v -4.823 c 0 -1.657 1.343 -3 3 -3 c 1.657 0 3 1.343 3 3 V 69.5 C 48 71.157 46.657 72.5 45 72.5 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(232,129,2); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 44.737 63.688 c -4.711 0 -9.153 -2.883 -10.902 -7.546 c -0.582 -1.552 0.204 -3.281 1.756 -3.862 c 1.549 -0.586 3.28 0.203 3.862 1.755 c 1.089 2.906 4.34 4.389 7.248 3.294 c 2.905 -1.09 4.384 -4.341 3.294 -7.248 c -0.624 -1.664 -1.967 -2.908 -3.685 -3.412 l -0.188 -0.062 l -4.224 -1.547 c -3.497 -1.06 -6.231 -3.618 -7.512 -7.033 c -1.091 -2.909 -0.983 -6.068 0.302 -8.896 c 1.285 -2.828 3.595 -4.986 6.504 -6.077 c 6.002 -2.25 12.72 0.801 14.972 6.806 c 0.582 1.551 -0.204 3.281 -1.755 3.863 c -1.547 0.579 -3.281 -0.203 -3.862 -1.755 c -1.09 -2.907 -4.341 -4.385 -7.249 -3.295 c -1.408 0.528 -2.526 1.573 -3.148 2.941 c -0.622 1.369 -0.674 2.898 -0.146 4.307 c 0.624 1.665 1.967 2.908 3.685 3.413 l 0.187 0.062 l 4.225 1.547 c 3.496 1.06 6.23 3.618 7.512 7.033 c 2.251 6.005 -0.803 12.722 -6.806 14.973 C 47.467 63.449 46.091 63.688 44.737 63.688 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(253,216,53); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 45 28.323 c -1.657 0 -3 -1.343 -3 -3 V 20.5 c 0 -1.657 1.343 -3 3 -3 c 1.657 0 3 1.343 3 3 v 4.823 C 48 26.979 46.657 28.323 45 28.323 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(253,216,53); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 45 68.5 c -1.657 0 -3 -1.343 -3 -3 v -4.823 c 0 -1.657 1.343 -3 3 -3 c 1.657 0 3 1.343 3 3 V 65.5 C 48 67.157 46.657 68.5 45 68.5 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(253,216,53); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                    </svg>
                    {{ auth()->user()->coins + 0}}
                </div>
            @endauth --}}
        </div>
    </div>
    <div x-data="videoPlayer()" x-init="init()">
        @if ($content->content_type === 'video')
            <video x-ref="video" class="w-full h-full max-w-full">
                @if (Storage::disk('public')->exists($content->source))
                    <source src="{{ asset('storage/' . $content->source) }}" type="video/mp4">
                    {{-- <source src="https://flowbite.com/docs/videos/flowbite.mp4" type="video/mp4"> --}}
                @else
                    <source src="{{ $content->source }}" type="video/mp4">
                    {{-- <source src="https://flowbite.com/docs/videos/flowbite.mp4" type="video/mp4"> --}}
                @endif
                Your browser does not support the video tag.
            </video>
        @else
            @if (Storage::disk('public')->exists($content->source))
                <img src="{{ asset('storage/' . $content->source) }}" alt="{{ $content->title }}"
                    onerror="this.onerror=null; this.src='{{ asset('placeholder-image.jpg') }}';">
            @else
                <img src="{{ $content->source }}" alt="{{ $content->title }}"
                    onerror="this.onerror=null; this.src='{{ asset('placeholder-image.jpg') }}';">
            @endif
        @endif
        @if ($content->content_type == 'video')
            <button type="button" @click="togglePlay" class="absolute inset-0 flex items-center justify-center">
                <template x-if="!isPlaying">
                    <svg class="text-white" stroke="currentColor" fill="currentColor" stroke-width="0"
                        viewBox="0 0 512 512" height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M133 440a35.37 35.37 0 01-17.5-4.67c-12-6.8-19.46-20-19.46-34.33V111c0-14.37 7.46-27.53 19.46-34.33a35.13 35.13 0 0135.77.45l247.85 148.36a36 36 0 010 61l-247.89 148.4A35.5 35.5 0 01133 440z">
                        </path>
                    </svg>
                </template>
            </button>
        @endif
        <div class="absolute top-1/2 right-0 z-10">
            <div class="flex flex-col px-4 space-y-6">
                @if ($previousContent)
                    <a href="{{ route('content', $previousContent->slug) }}" class="text-white p-2 rounded-full">
                        <svg class="h-5 w-5" stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M256 217.9L383 345c9.4 9.4 24.6 9.4 33.9 0 9.4-9.4 9.3-24.6 0-34L273 167c-9.1-9.1-23.7-9.3-33.1-.7L95 310.9c-4.7 4.7-7 10.9-7 17s2.3 12.3 7 17c9.4 9.4 24.6 9.4 33.9 0l127.1-127z">
                            </path>
                        </svg>
                    </a>
                @else
                    <button type="button" class="text-white p-2 rounded-full" disabled>
                        <svg class="h-5 w-5 text-gray-600" stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M256 217.9L383 345c9.4 9.4 24.6 9.4 33.9 0 9.4-9.4 9.3-24.6 0-34L273 167c-9.1-9.1-23.7-9.3-33.1-.7L95 310.9c-4.7 4.7-7 10.9-7 17s2.3 12.3 7 17c9.4 9.4 24.6 9.4 33.9 0l127.1-127z">
                            </path>
                        </svg>
                    </button>
                @endif
                @if ($nextContent)
                    <a href="{{ route('content', $nextContent->slug) }}" class="text-white p-2 rounded-full">
                        <svg class="h-5 w-5" stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z">
                            </path>
                        </svg>
                    </a>
                @else
                    <button type="button" class="text-white p-2 rounded-full" disabled>
                        <svg class="h-5 w-5 text-gray-600" stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z">
                            </path>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full">
            <div class="px-4 mb-4">
                <h1 class="font-bold text-sm text-white mr-10">{{ $content->title }}</h1>
            </div>
            <div class="flex flex-wrap min-[398px]:flex-nowrap gap-4 items-center justify-between px-4 mb-6">
                <a href="{{ route('package', $content->package->slug) }}"
                    class="flex items-center justify-between bg-black/60 text-white text-xs font-semibold py-2 px-4 rounded-full">
                    <span class="mr-2">
                        Click to watch more like this
                    </span>
                    <svg stroke="currentColor" fill="none" stroke-width="1.5" viewBox="0 0 24 24"
                        aria-hidden="true" height="15" width="15" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3">
                        </path>
                    </svg>
                </a>
                @if ($content->content_type === 'video')
                    <div class="space-x-2">
                        <!-- Play/Pause Button -->
                        <button @click="togglePlay" class="text-white p-2 rounded-full bg-gray-600">
                            <template x-if="!isPlaying">
                                <svg class="h-5 w-5" stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 512 512" height="2em" width="2em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" stroke-miterlimit="10" stroke-width="32"
                                        d="M112 111v290c0 17.44 17 28.52 31 20.16l247.9-148.37c12.12-7.25 12.12-26.33 0-33.58L143 90.84c-14-8.36-31 2.72-31 20.16z">
                                    </path>
                                </svg>
                            </template>
                            <template x-if="isPlaying">
                                <svg class="h-5 w-5" stroke="currentColor" fill="none" stroke-width="1.5"
                                    viewBox="0 0 24 24" aria-hidden="true" height="2em" width="2em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 5.25v13.5m-7.5-13.5v13.5">
                                    </path>
                                </svg>
                            </template>
                        </button>

                        <!-- Mute/Unmute Button -->
                        <button @click="toggleMute" class="text-white p-2 rounded-full bg-gray-600">
                            <template x-if="!isMuted">
                                <svg class="h-5 w-5" stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 512 512" height="2em" width="2em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M296 416.19a23.92 23.92 0 01-14.21-4.69l-.66-.51-91.46-75H120a24 24 0 01-24-24V200a24 24 0 0124-24h69.65l91.46-75 .66-.51A24 24 0 01320 119.83v272.34a24 24 0 01-24 24zM384 336a16 16 0 01-14.29-23.18c9.49-18.9 14.3-38 14.3-56.82 0-19.36-4.66-37.92-14.25-56.73a16 16 0 0128.5-14.54C410.2 208.16 416 231.47 416 256c0 23.83-6 47.78-17.7 71.18A16 16 0 01384 336z">
                                    </path>
                                </svg>
                            </template>
                            <template x-if="isMuted">
                                <svg class="h-5 w-5" stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 512 512" height="2em" width="2em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="32" d="M416 432L64 80"></path>
                                    <path
                                        d="M243.33 98.86a23.89 23.89 0 00-25.55 1.82l-.66.51-28.52 23.35a8 8 0 00-.59 11.85l54.33 54.33a8 8 0 0013.66-5.66v-64.49a24.51 24.51 0 00-12.67-21.71zm8 236.43L96.69 180.69A16 16 0 0085.38 176H56a24 24 0 00-24 24v112a24 24 0 0024 24h69.76l92 75.31a23.9 23.9 0 0025.87 1.69A24.51 24.51 0 00256 391.45v-44.86a16 16 0 00-4.67-11.3zM352 256c0-24.56-5.81-47.87-17.75-71.27a16 16 0 10-28.5 14.55C315.34 218.06 320 236.62 320 256q0 4-.31 8.13a8 8 0 002.32 6.25l14.36 14.36a8 8 0 0013.55-4.31A146 146 0 00352 256zm64 0c0-51.18-13.08-83.89-34.18-120.06a16 16 0 00-27.64 16.12C373.07 184.44 384 211.83 384 256c0 23.83-3.29 42.88-9.37 60.65a8 8 0 001.9 8.26L389 337.4a8 8 0 0013.13-2.79C411 311.76 416 287.26 416 256z">
                                    </path>
                                    <path
                                        d="M480 256c0-74.25-20.19-121.11-50.51-168.61a16 16 0 10-27 17.22C429.82 147.38 448 189.5 448 256c0 46.19-8.43 80.27-22.43 110.53a8 8 0 001.59 9l11.92 11.92a8 8 0 0012.92-2.16C471.6 344.9 480 305 480 256z">
                                    </path>
                                </svg>
                            </template>
                        </button>

                        <!-- Full Screen Button -->
                        <button @click="toggleFullScreen" class="text-white p-2 rounded-full bg-gray-600">
                            <svg class="h-5 w-5" stroke="currentColor" fill="none" stroke-width="0"
                                viewBox="0 0 15 15" height="2em" width="2em"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2 2.5C2 2.22386 2.22386 2 2.5 2H5.5C5.77614 2 6 2.22386 6 2.5C6 2.77614 5.77614 3 5.5 3H3V5.5C3 5.77614 2.77614 6 2.5 6C2.22386 6 2 5.77614 2 5.5V2.5ZM9 2.5C9 2.22386 9.22386 2 9.5 2H12.5C12.7761 2 13 2.22386 13 2.5V5.5C13 5.77614 12.7761 6 12.5 6C12.2239 6 12 5.77614 12 5.5V3H9.5C9.22386 3 9 2.77614 9 2.5ZM2.5 9C2.77614 9 3 9.22386 3 9.5V12H5.5C5.77614 12 6 12.2239 6 12.5C6 12.7761 5.77614 13 5.5 13H2.5C2.22386 13 2 12.7761 2 12.5V9.5C2 9.22386 2.22386 9 2.5 9ZM12.5 9C12.7761 9 13 9.22386 13 9.5V12.5C13 12.7761 12.7761 13 12.5 13H9.5C9.22386 13 9 12.7761 9 12.5C9 12.2239 9.22386 12 9.5 12H12V9.5C12 9.22386 12.2239 9 12.5 9Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            @if ($content->content_type === 'video')
                <div class="w-full h-1 bg-gray-600 cursor-pointer" @click="seek($event)">
                    <div class="h-1 bg-white" :style="`width: ${progress}%`"></div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function videoPlayer() {
            return {
                video: null,
                isPlaying: false,
                autoplay: true,
                isMuted: true,
                volume: 1,
                currentTime: 0,
                duration: 0,
                progress: 0,

                init() {
                    this.video = this.$refs.video;
                    this.video.volume = this.volume; // Set initial volume
                    this.video.addEventListener('timeupdate', this.updateProgress.bind(this));
                    this.video.addEventListener('loadedmetadata', this.updateDuration.bind(this));
                    this.video.addEventListener('ended', () => this.isPlaying = false);

                    // Autoplay
                    this.$refs.video.muted = true;
                    if (this.autoplay) {
                        this.video.play().then(() => {
                            this.isPlaying = true;
                        }).catch(() => {
                            console.log("Autoplay was blocked.");
                        });
                    }

                    this.duration = this.$refs.video.duration;
                },

                togglePlay() {
                    if (this.video.paused) {
                        this.video.play();
                        this.isPlaying = true;
                    } else {
                        this.video.pause();
                        this.isPlaying = false;
                    }
                },

                toggleMute() {
                    this.video.muted = !this.video.muted;
                    this.isMuted = this.video.muted;
                },

                updateVolume() {
                    this.video.volume = this.volume;
                    this.isMuted = this.volume === 0;
                },

                seek(event) {
                    const video = this.$refs.video;
                    const newTime = (event.target.value / 100) * video.duration;
                    video.currentTime = newTime;
                },

                updateProgress() {
                    const video = this.$refs.video;
                    this.currentTime = video.currentTime;
                    this.progress = (video.currentTime / video.duration) * 100;
                },

                updateDuration() {
                    this.duration = this.$refs.video.duration;
                },

                formatTime(time) {
                    const minutes = Math.floor(time / 60);
                    const seconds = Math.floor(time % 60);
                    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                },

                toggleFullScreen() {
                    if (!document.fullscreenElement) {
                        this.video.requestFullscreen();
                    } else {
                        document.exitFullscreen();
                    }
                }
            };
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let previousUrl = "{{ $previousContent ? route('content', $previousContent->slug) : '' }}";
            let nextUrl = "{{ $nextContent ? route('content', $nextContent->slug) : '' }}";

            // 🔼 Navigasi dengan Arrow Up & Down (Keyboard)
            document.addEventListener("keydown", function(event) {
                if (event.key === "ArrowUp" && previousUrl) {
                    window.location.href = previousUrl;
                } else if (event.key === "ArrowDown" && nextUrl) {
                    window.location.href = nextUrl;
                }
            });

            // 📜 Navigasi dengan Scroll (Desktop)
            let isScrolling = false;
            let scrollTimeout;

            window.addEventListener("wheel", function(event) {
                if (isScrolling) return;

                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    if (event.deltaY > 50 && nextUrl) {
                        isScrolling = true;
                        window.location.href = nextUrl; // Scroll ke bawah → nextContent
                    } else if (event.deltaY < -50 && previousUrl) {
                        isScrolling = true;
                        window.location.href = previousUrl; // Scroll ke atas → previousContent
                    }
                }, 200); // Tambahkan sedikit delay agar tidak terlalu sensitif
            });

            // 📱 Navigasi dengan Swipe (Mobile)
            let touchStartY = 0;
            let touchEndY = 0;

            document.addEventListener("touchstart", function(event) {
                touchStartY = event.touches[0].clientY;
            });

            document.addEventListener("touchend", function(event) {
                touchEndY = event.changedTouches[0].clientY;
                handleSwipe();
            });

            function handleSwipe() {
                let swipeDistance = touchStartY - touchEndY;

                if (swipeDistance > 50 && nextUrl) {
                    // Swipe ke atas (ke bawah) → nextContent
                    window.location.href = nextUrl;
                } else if (swipeDistance < -50 && previousUrl) {
                    // Swipe ke bawah (ke atas) → previousContent
                    window.location.href = previousUrl;
                }
            }
        });
    </script>

</x-player-layout>
