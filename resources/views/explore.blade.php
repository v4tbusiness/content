<x-user-layout>
    <x-slot name="title">
        {{ $setting->site_name }} - Explore
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
        <meta property="og:title" content="{{ $setting->site_name }} - Explore">
        <meta property="og:description" content="{{ $setting->site_description }}">
        <meta property="og:image" content="{{ asset($setting->logo) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $setting->site_name }} - Explore">
        <meta property="twitter:description" content="{{ $setting->site_description }}">
        <meta property="twitter:image" content="{{ asset($setting->logo) }}">

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
                  "name": "Explore",
                  "item": "{{ url()->current() }}"
                }
              ]
            }
        </script>
    </x-slot>

    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Explore') }}
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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Explore</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <form action="{{ route('explore') }}" method="GET" class="flex items-center max-w-md mx-auto mb-4">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <input type="text" name="search" id="simple-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for videos or images..." value="{{ request('search') }}" />
        </div>
        <button type="submit"
            class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

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
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $contents->appends(request()->query())->links() }}
    </div>
</x-user-layout>
