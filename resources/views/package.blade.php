<x-user-layout>
    <x-slot name="title">
        {{ $package->name }} - {{ $setting->site_name }}
    </x-slot>

    <x-slot name="meta">
        <!-- Meta Description -->
        <meta name="description" content="{{ $package->description }}">

        <!-- Meta Keywords -->
        <meta name="keywords" content="{{ 'package, content, video, image' }}">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $package->name }} - {{ $setting->site_name }}">
        <meta property="og:description" content="{{ $package->description }}">
        <meta property="og:image" content="{{ asset($package->cover) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $package->name }} - {{ $setting->site_name }}">
        <meta property="twitter:description" content="{{ $package->description }}">
        <meta property="twitter:image" content="{{ asset($package->cover) }}">

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
                  "name": "{{ $package->name }}",
                  "item": "{{ url()->current() }}"
                }
              ]
            }
        </script>
    </x-slot>

    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $package->name }}
        </h1>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse list-none px-0 *:mb-0">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Packages</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span
                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $package->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>
    @if (session('success'))
        <div id="alert-3"
            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @if (session('confirm'))
        <!-- Modal toggle -->
        <button data-modal-target="progress-modal" data-modal-toggle="progress-modal"
            class="sr-only block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Toggle modal
        </button>

        <!-- Main modal -->
        <div id="progress-modal" tabindex="-1" aria-hidden="true"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="progress-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500 mb-4" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M20 10H4v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8ZM9 13v-1h6v1a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z"
                                clip-rule="evenodd" />
                            <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2Z" />
                        </svg>
                        <h3 class="mb-1 text-xl font-bold text-indigo-500 dark:text-white">{{ $package->name }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">{{ $package->description }}
                        <p>
                        <div class="flex justify-end mb-1 text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256"
                                    height="256" viewBox="0 0 256 256" xml:space="preserve">

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
                                <span class="text-sm font-medium text-gray-600 leading-normal">
                                    <span
                                        class="text-sm font-semibold text-gray-900 dark:text-white">{{ $package->price }}
                                        /
                                        {{ $contents->count() }} Contents</span>
                                </span>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center mt-6 space-x-4 rtl:space-x-reverse">
                            <form action="{{ route('purchases.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <button data-modal-hide="progress-modal" type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buy
                                    Package</button>
                            </form>
                            <button data-modal-hide="progress-modal" type="button"
                                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
            class="sr-only block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Toggle modal
        </button>

        <div id="popup-modal" tabindex="-1"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">

                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z" />
                        </svg>

                        <div class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            {!! session('error') !!}
                            <div class="sr-only">
                                <h3 class="text-xl font-semibold text-red-500">This is Premium Content</h3>
                                <p>Please top up at least <span class="font-semibold text-gray-800">1,000 Coins</span>
                                    to unlock <span class="font-semibold text-gray-800">1,000 Contents</span> in the
                                    <span class="font-bold text-indigo-500">PRO123</span> package.
                                </p>
                            </div>
                        </div>
                        <a data-modal-hide="popup-modal" href="{{ route('topup') }}"
                            class="block w-full text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm items-center px-5 py-2.5 text-center">
                            Topup Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-3 gap-2">
        @foreach ($contents as $content)
            <a href="{{ route('content', $content->slug) }}" class="relative">
                @if (Storage::disk('public')->exists($content->thumbnail))
                    <img class="h-auto max-w-full rounded-lg aspect-[9/16] object-cover"
                        src="{{ asset('storage/' . $content->thumbnail) }}" alt="{{ $content->title }}"
                        onerror="this.onerror=null; this.src='{{ asset('placeholder-image.jpg') }}';">
                @else
                    <img class="h-auto max-w-full rounded-lg aspect-[9/16] object-cover"
                        src="{{ $content->thumbnail }}" alt="{{ $content->title }}"
                        onerror="this.onerror=null; this.src='{{ asset('placeholder-image.jpg') }}';">
                @endif
                @if ($content->content_type == 'video')
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="text-white" stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 512 512" height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M133 440a35.37 35.37 0 01-17.5-4.67c-12-6.8-19.46-20-19.46-34.33V111c0-14.37 7.46-27.53 19.46-34.33a35.13 35.13 0 0135.77.45l247.85 148.36a36 36 0 010 61l-247.89 148.4A35.5 35.5 0 01133 440z">
                            </path>
                        </svg>
                    </div>
                @endif
                @if ($content->is_premium)
                    @if ($content->content_type == 'image')
                        <div class="absolute inset-0 backdrop-blur-sm bg-black/30"></div>
                    @endif
                @endif
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $contents->appends(request()->query())->links() }}
    </div>

</x-user-layout>
