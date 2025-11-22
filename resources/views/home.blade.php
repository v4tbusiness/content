<x-user-layout>
    <x-slot name="title">
        {{ $setting->site_name }}
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
        <meta property="og:title" content="{{ $setting->site_name }}">
        <meta property="og:description" content="{{ $setting->site_description }}">
        <meta property="og:image" content="{{ asset($setting->logo) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $setting->site_name }}">
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
                }
              ]
            }
        </script>
    </x-slot>

    <x-slot name="header">
        {!! $setting->main_header !!}
    </x-slot>
    <div class="flex flex-wrap space-y-4">

        @foreach ($packages as $package)
            @php
                if (Storage::disk('public')->exists($package->cover)) {
                    $backgroundImage = asset('storage/' . $package->cover);
                } else {
                    $backgroundImage = $package->cover;
                }
            @endphp
            <div {{-- class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700"> --}}
                class="w-full p-6 rounded-lg shadow-sm bg-cover bg-no-repeat bg-gray-700 bg-blend-multiply"
                style="background-image: url('{{ $backgroundImage }}');">
                <a href="{{ route('package', $package->slug) }}">
                    <h2 class="mb-2 text-xl font-extrabold tracking-tight text-white">
                        {{ $package->name }}</h2>
                </a>
                <p class="mb-3 text-sm font-normal text-gray-300">{{ $package->description }}</p>
                {{-- <a href="{{ route('package', $package->slug) }}"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Explore
                    Now</a> --}}
                <a href="{{ route('package', $package->slug) }}"
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-white rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-transparent">
                        Explore Now
                    </span>
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $packages->appends(request()->query())->links() }}
    </div>

</x-user-layout>
