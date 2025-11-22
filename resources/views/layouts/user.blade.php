<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    @isset($title)
        <title>{{ $title }}</title>
    @endisset

    @isset($meta)
        {{ $meta }}
    @endisset

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        h1 {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            /* 20px + Spasi bawah */
        }

        h2 {
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            /* 18px + Spasi bawah */
        }

        h3 {
            font-size: 1rem;
            line-height: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            /* 16px + Spasi bawah */
        }

        h4 {
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            /* 14px + Spasi bawah */
        }

        h5 {
            font-size: 0.75rem;
            line-height: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            /* 12px + Spasi bawah */
        }

        h6 {
            font-size: 0.75rem;
            line-height: 1rem;
            font-weight: 400;
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity, 1));
            /* 12px + Spasi bawah */
        }

        p {
            font-size: 1rem;
            line-height: 1.625;
            margin-bottom: 1rem;
            /* 16px + Spasi bawah + Line height nyaman */
        }

        ul {
            list-style-type: disc;
            padding-left: 1.25rem;
            margin-bottom: 1rem;
            /* Bullet list, padding kiri, spasi bawah */
        }

        ol {
            list-style-type: decimal;
            padding-left: 1.25rem;
            margin-bottom: 1rem;
            /* Numbered list, padding kiri, spasi bawah */
        }

        li {
            font-size: 1rem;
            line-height: 1.625;
            margin-bottom: 0.5rem;
            /* Ukuran standar, line height nyaman, spasi antar item */
        }

        {{ $setting->custom_css }}
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100 dark:bg-gray-900">

        <div class="relative min-h-screen w-full sm:max-w-md bg-white dark:bg-gray-800 shadow-md overflow-hidden">
            @include('layouts.navbar')

            <!-- Page Heading -->
            @isset($header)
                <header>
                    <div class="max-w-7xl mx-auto px-4 mt-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-4 mb-16">
                {{ $slot }}
            </main>

            @include('layouts.bottom-navigation')
        </div>
    </div>
</body>

</html>
