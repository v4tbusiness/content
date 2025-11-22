@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white bg-gray-100 dark:bg-gray-700 transition duration-75'
            : 'flex items-center p-2 text-gray-500 hover:text-gray-900 rounded-lg dark:text-gray-400 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-75';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
