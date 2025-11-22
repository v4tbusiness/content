<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Import') }}
        </h2>
    </x-slot>

    <div class="max-w-xl">
        <form method="post" action="{{ route('storeImport') }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-input-label for="api_key">
                    {{ __('Api Key') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="api_key" class="mt-1 block w-full" type="text" name="api_key" :value="old('api_key')"
                    autofocus autocomplete="api_key" required />
                <x-input-error :messages="$errors->get('api_key')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="api_secret">
                    {{ __('Api Secret') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="api_secret" class="mt-1 block w-full" type="text" name="api_secret"
                    :value="old('api_secret')" autocomplete="api_secret" required />
                <x-input-error :messages="$errors->get('api_secret')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="bucket">
                    {{ __('Bucket') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="bucket" class="mt-1 block w-full" type="text" name="bucket" :value="old('bucket')"
                    autocomplete="bucket" required placeholder="your-bucket-name" />
                <x-input-error :messages="$errors->get('bucket')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="region">
                    {{ __('Region') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="region" class="mt-1 block w-full" type="text" name="region" :value="old('region')"
                    autocomplete="region" required placeholder="nyc3" />
                <x-input-error :messages="$errors->get('region')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="folder">
                    {{ __('Folder') }} <span class="text-gray-500">(optional)</span>
                </x-input-label>
                <x-text-input id="folder" class="mt-1 block w-full" type="text" name="folder" :value="old('folder')"
                    autocomplete="folder" placeholder="" />
                <x-input-error :messages="$errors->get('folder')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="package_id">
                    {{ __('Package') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-select-input id="package_id" class="mt-1 block w-full" name="package_id">
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">
                            {{ $package->name }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('package_id')" class="mt-2" />
            </div>

            <div>
                <label class="inline-flex items-center cursor-pointer">
                    <input id="is_premium" type="checkbox" name="is_premium" value="1" class="sr-only peer"
                        @checked(old('is_premium')) x-data="{ checked: @json(old('is_premium', false)) }" x-model="checked">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Premium</span>
                </label>
                <x-input-error :messages="$errors->get('is_premium')" class="mt-2" />
            </div>

            <div x-data="{ showTrials: @json(old('is_premium', false)) }" x-show="showTrials">
                <x-input-label for="number_of_trials">
                    {{ __('Number of Trials') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="number_of_trials" class="mt-1 block w-full" type="number" name="number_of_trials"
                    :value="old('number_of_trials', 0)" min="0" required />
                <x-input-error :messages="$errors->get('number_of_trials')" class="mt-2" />
            </div>

            <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const isPremiumCheckbox = document.getElementById("is_premium");
                const trialsInputContainer = document.querySelector("[x-data='{ showTrials: false }']");

                function toggleTrialsInput() {
                    trialsInputContainer.style.display = isPremiumCheckbox.checked ? "block" : "none";
                }

                isPremiumCheckbox.addEventListener("change", toggleTrialsInput);
                toggleTrialsInput(); // Inisialisasi saat halaman dimuat
            });
        </script>
    </div>

</x-admin-layout>
