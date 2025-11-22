<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Page') }}
        </h2>
    </x-slot>

    <div class="max-w-xl">
        <form method="post" action="{{ route('pages.store') }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-input-label for="title">
                    {{ __('Title') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="title" class="mt-1 block w-full" type="text" name="title" :value="old('title')"
                    autofocus autocomplete="title" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="slug">
                    {{ __('Slug') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="slug" class="mt-1 block w-full" type="text" name="slug" :value="old('slug')"
                    autocomplete="slug" required />
                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="content">
                    {{ __('Content') }} <span class="text-red-500">*</span>
                </x-input-label>
                <div class="mt-1 block w-full">
                    <x-text-editor>
                        <input type="hidden" id="wysiwyg-hiddenInput" name="content" value="{{ old('content') }}">
                        <div
                            id="wysiwyg"class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400">
                        </div>
                    </x-text-editor>
                </div>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </form>
    </div>

</x-admin-layout>
