<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Content') }}
        </h2>
    </x-slot>
    <div class="max-w-xl">
        <form method="post" action="{{ route('contents.update', $content->id) }}" class="mt-6 space-y-6"
            enctype="multipart/form-data" x-data="{ content_type: '{{ old('content_type', $content->content_type) }}', source_type: '{{ old('source_type', $content->source_type) }}' }">
            @csrf
            @method('put')

            <div>
                <label class="inline-flex items-center cursor-pointer">
                    <input id="is_premium" type="checkbox" name="is_premium" value="1" class="sr-only peer"
                        @checked(old('is_premium', $content->is_premium))>
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Premium</span>
                </label>
                <x-input-error :messages="$errors->get('is_premium')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="title">
                    {{ __('Title') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="title" class="mt-1 block w-full" type="text" name="title" :value="old('title', $content->title)"
                    autofocus autocomplete="title" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="slug">
                    {{ __('Slug') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="slug" class="mt-1 block w-full" type="text" name="slug" :value="old('slug', $content->slug)"
                    autofocus autocomplete="slug" required />
                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="package_id">
                    {{ __('Package') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-select-input id="package_id" class="mt-1 block w-full" name="package_id">
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}"
                            {{ $content->package_id == $package->id ? 'selected' : '' }}>
                            {{ $package->name }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('package_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="content_type">
                    {{ __('Content Type') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-select-input id="content_type" class="mt-1 block w-full" name="content_type" x-model="content_type">
                    <option value="video" {{ $content->content_type == 'video' ? 'selected' : '' }}>
                        video
                    </option>
                    <option value="image" {{ $content->content_type == 'image' ? 'selected' : '' }}>
                        image</option>
                </x-select-input>
                <x-input-error :messages="$errors->get('content_type')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="source_type">
                    {{ __('Source Type') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-select-input id="source_type" class="mt-1 block w-full" name="source_type" x-model="source_type">
                    <option value="file" {{ $content->source_type == 'file' ? 'selected' : '' }}>file
                    </option>
                    <option value="url" {{ $content->source_type == 'url' ? 'selected' : '' }}>url
                    </option>
                </x-select-input>
                <x-input-error :messages="$errors->get('source_type')" class="mt-2" />
            </div>

            <div x-show="source_type === 'file'">
                <x-input-label for="source" :value="__('Source File')" />
                <x-file-input id="source" type="file" x-bind:name="source_type === 'file' ? 'source' : null"
                    class="mt-1 block w-full" onchange="previewSource(event)" />
                <div x-show="content_type === 'image'">
                    @if ($content->source)
                        @if (Storage::disk('public')->exists($content->source))
                            <img id="source-image-preview"
                                src="{{ old('source', asset('storage/' . $content->source)) }}"
                                class="mt-2 h-auto max-w-full object-cover rounded-lg" />
                        @else
                            <img id="source-image-preview" src="{{ old('source', $content->source) }}"
                                class="mt-2 h-auto max-w-full object-cover rounded-lg" />
                        @endif
                    @else
                        <img id="source-image-preview" class="mt-2 hidden h-auto max-w-full object-cover rounded-lg" />
                    @endif
                </div>
                <x-input-error :messages="$errors->get('source')" class="mt-2" />
            </div>

            <div x-show="source_type === 'url'">
                <x-input-label for="source">
                    {{ __('Source Url') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="source" class="mt-1 block w-full" type="text"
                    x-bind:name="source_type === 'url' ? 'source' : null" :value="old('source', $content->source)" autocomplete="source"
                    x-bind:required="source_type === 'url'" />
                <x-input-error :messages="$errors->get('source')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                <x-file-input id="thumbnail" type="file" name="thumbnail" class="mt-1 block w-full"
                    onchange="previewImage(event)" />
                @if ($content->thumbnail)
                    @if (Storage::disk('public')->exists($content->thumbnail))
                        <img id="image-preview" src="{{ old('thumbnail', asset('storage/' . $content->thumbnail)) }}"
                            class="mt-2 h-auto max-w-full object-cover rounded-lg" />
                    @else
                        <img id="image-preview" src="{{ old('thumbnail', $content->thumbnail) }}"
                            class="mt-2 h-auto max-w-full object-cover rounded-lg" />
                    @endif
                @else
                    <img id="image-preview" class="mt-2 hidden h-auto max-w-full object-cover rounded-lg" />
                @endif
                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
            </div>

            <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </form>
        <script>
            function previewSource(event) {
                const input = event.target;
                const preview = document.getElementById('source-image-preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('image-preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </div>

</x-admin-layout>
