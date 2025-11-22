<x-user-layout>
    <x-slot name="title">
        {{ $page->title }} - {{ $setting->site_name }}
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
        <meta property="og:title" content="{{ $page->title }} - {{ $setting->site_name }}">
        <meta property="og:description" content="{{ $setting->site_description }}">
        <meta property="og:image" content="{{ asset($setting->logo) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $page->title }} - {{ $setting->site_name }}">
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
                  "name": "{{ $page->title }}",
                  "item": "{{ url()->current() }}"
                }
              ]
            }
        </script>
    </x-slot>

    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $page->title }}
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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Pages</span>
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
                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $page->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>
    <article>
        {!! $page->content !!}
    </article>
</x-user-layout>
