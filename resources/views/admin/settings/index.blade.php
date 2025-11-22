<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="max-w-xl">
        <form method="post" action="{{ route('settings.update', $setting->id) }}" class="mt-6 space-y-6"
            enctype="multipart/form-data" x-data="{ currency: '{{ old('currency', $setting->currency) }}' }">
            @csrf
            @method('put')

            <div>
                <x-input-label for="site_name">
                    {{ __('Site Name') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="site_name" class="mt-1 block w-full" type="text" name="site_name" :value="old('site_name', $setting->site_name)"
                    autofocus autocomplete="site_name" required />
                <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="site_description">
                    {{ __('Site Description') }} <span class="text-red-500">*</span>
                </x-input-label>
                <textarea id="site_description" name="site_description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" required>{{ old('site_description', $setting->site_description) }}</textarea>
                <x-input-error :messages="$errors->get('site_description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="logo" :value="__('Logo')" />
                <x-file-input id="logo" type="file" name="logo" class="mt-1 block w-full"
                    onchange="previewImage(event)" />
                @if ($setting->logo)
                    @if (Storage::disk('public')->exists($setting->logo))
                        <img id="image-preview" src="{{ old('logo', asset($setting->logo)) }}"
                            class="mt-2 h-auto max-w-full object-cover rounded-lg" />
                    @else
                        <img id="image-preview" src="{{ old('logo', $setting->logo) }}"
                            class="mt-2 h-auto max-w-full object-cover rounded-lg" />
                    @endif
                @else
                    <img id="image-preview" class="mt-2 hidden h-auto max-w-full object-cover rounded-lg" />
                @endif
                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="currency">
                    {{ __('Currency') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-select-input id="currency" class="mt-1 block w-full" name="currency" x-model="currency">
                    <option value="AFN" {{ $setting->currency == 'AFN' ? 'selected' : '' }}>AFN - Afghan Afghani
                    </option>
                    <option value="ALL" {{ $setting->currency == 'ALL' ? 'selected' : '' }}>ALL - Albanian Lek
                    </option>
                    <option value="DZD" {{ $setting->currency == 'DZD' ? 'selected' : '' }}>DZD - Algerian Dinar
                    </option>
                    <option value="AOA" {{ $setting->currency == 'AOA' ? 'selected' : '' }}>AOA - Angolan Kwanza
                    </option>
                    <option value="ARS" {{ $setting->currency == 'ARS' ? 'selected' : '' }}>ARS - Argentine Peso
                    </option>
                    <option value="AMD" {{ $setting->currency == 'AMD' ? 'selected' : '' }}>AMD - Armenian Dram
                    </option>
                    <option value="AWG" {{ $setting->currency == 'AWG' ? 'selected' : '' }}>AWG - Aruban Florin
                    </option>
                    <option value="AUD" {{ $setting->currency == 'AUD' ? 'selected' : '' }}>AUD - Australian Dollar
                    </option>
                    <option value="AZN" {{ $setting->currency == 'AZN' ? 'selected' : '' }}>AZN - Azerbaijani Manat
                    </option>
                    <option value="BSD" {{ $setting->currency == 'BSD' ? 'selected' : '' }}>BSD - Bahamian Dollar
                    </option>
                    <option value="BHD" {{ $setting->currency == 'BHD' ? 'selected' : '' }}>BHD - Bahraini Dinar
                    </option>
                    <option value="BDT" {{ $setting->currency == 'BDT' ? 'selected' : '' }}>BDT - Bangladeshi Taka
                    </option>
                    <option value="BBD" {{ $setting->currency == 'BBD' ? 'selected' : '' }}>BBD - Barbadian Dollar
                    </option>
                    <option value="BYN" {{ $setting->currency == 'BYN' ? 'selected' : '' }}>BYN - Belarusian Ruble
                    </option>
                    <option value="BZD" {{ $setting->currency == 'BZD' ? 'selected' : '' }}>BZD - Belize Dollar
                    </option>
                    <option value="BMD" {{ $setting->currency == 'BMD' ? 'selected' : '' }}>BMD - Bermudian Dollar
                    </option>
                    <option value="BTN" {{ $setting->currency == 'BTN' ? 'selected' : '' }}>BTN - Bhutanese Ngultrum
                    </option>
                    <option value="BOB" {{ $setting->currency == 'BOB' ? 'selected' : '' }}>BOB - Bolivian Boliviano
                    </option>
                    <option value="BAM" {{ $setting->currency == 'BAM' ? 'selected' : '' }}>BAM - Bosnia-Herzegovina
                        Convertible Mark</option>
                    <option value="BWP" {{ $setting->currency == 'BWP' ? 'selected' : '' }}>BWP - Botswana Pula
                    </option>
                    <option value="BRL" {{ $setting->currency == 'BRL' ? 'selected' : '' }}>BRL - Brazilian Real
                    </option>
                    <option value="GBP" {{ $setting->currency == 'GBP' ? 'selected' : '' }}>GBP - British Pound
                        Sterling</option>
                    <option value="BND" {{ $setting->currency == 'BND' ? 'selected' : '' }}>BND - Brunei Dollar
                    </option>
                    <option value="BGN" {{ $setting->currency == 'BGN' ? 'selected' : '' }}>BGN - Bulgarian Lev
                    </option>
                    <option value="BIF" {{ $setting->currency == 'BIF' ? 'selected' : '' }}>BIF - Burundian Franc
                    </option>
                    <option value="KHR" {{ $setting->currency == 'KHR' ? 'selected' : '' }}>KHR - Cambodian Riel
                    </option>
                    <option value="CAD" {{ $setting->currency == 'CAD' ? 'selected' : '' }}>CAD - Canadian Dollar
                    </option>
                    <option value="CNY" {{ $setting->currency == 'CNY' ? 'selected' : '' }}>CNY - Chinese Yuan
                    </option>
                    <option value="COP" {{ $setting->currency == 'COP' ? 'selected' : '' }}>COP - Colombian Peso
                    </option>
                    <option value="HRK" {{ $setting->currency == 'HRK' ? 'selected' : '' }}>HRK - Croatian Kuna
                    </option>
                    <option value="CZK" {{ $setting->currency == 'CZK' ? 'selected' : '' }}>CZK - Czech Koruna
                    </option>
                    <option value="DKK" {{ $setting->currency == 'DKK' ? 'selected' : '' }}>DKK - Danish Krone
                    </option>
                    <option value="EGP" {{ $setting->currency == 'EGP' ? 'selected' : '' }}>EGP - Egyptian Pound
                    </option>
                    <option value="EUR" {{ $setting->currency == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                    <option value="HKD" {{ $setting->currency == 'HKD' ? 'selected' : '' }}>HKD - Hong Kong Dollar
                    </option>
                    <option value="HUF" {{ $setting->currency == 'HUF' ? 'selected' : '' }}>HUF - Hungarian Forint
                    </option>
                    <option value="INR" {{ $setting->currency == 'INR' ? 'selected' : '' }}>INR - Indian Rupee
                    </option>
                    <option value="IDR" {{ $setting->currency == 'IDR' ? 'selected' : '' }}>IDR - Indonesian Rupiah
                    </option>
                    <option value="ILS" {{ $setting->currency == 'ILS' ? 'selected' : '' }}>ILS - Israeli New Shekel
                    </option>
                    <option value="JPY" {{ $setting->currency == 'JPY' ? 'selected' : '' }}>JPY - Japanese Yen
                    </option>
                    <option value="KRW" {{ $setting->currency == 'KRW' ? 'selected' : '' }}>KRW - South Korean Won
                    </option>
                    <option value="MYR" {{ $setting->currency == 'MYR' ? 'selected' : '' }}>MYR - Malaysian Ringgit
                    </option>
                    <option value="MXN" {{ $setting->currency == 'MXN' ? 'selected' : '' }}>MXN - Mexican Peso
                    </option>
                    <option value="NOK" {{ $setting->currency == 'NOK' ? 'selected' : '' }}>NOK - Norwegian Krone
                    </option>
                    <option value="NZD" {{ $setting->currency == 'NZD' ? 'selected' : '' }}>NZD - New Zealand Dollar
                    </option>
                    <option value="PHP" {{ $setting->currency == 'PHP' ? 'selected' : '' }}>PHP - Philippine Peso
                    </option>
                    <option value="PLN" {{ $setting->currency == 'PLN' ? 'selected' : '' }}>PLN - Polish Złoty
                    </option>
                    <option value="RUB" {{ $setting->currency == 'RUB' ? 'selected' : '' }}>RUB - Russian Ruble
                    </option>
                    <option value="SGD" {{ $setting->currency == 'SGD' ? 'selected' : '' }}>SGD - Singapore Dollar
                    </option>
                    <option value="THB" {{ $setting->currency == 'THB' ? 'selected' : '' }}>THB - Thai Baht</option>
                    <option value="TRY" {{ $setting->currency == 'TRY' ? 'selected' : '' }}>TRY - Turkish Lira
                    </option>
                    <option value="USD" {{ $setting->currency == 'USD' ? 'selected' : '' }}>USD - United States
                        Dollar</option>
                    <option value="ZAR" {{ $setting->currency == 'ZAR' ? 'selected' : '' }}>ZAR - South African Rand
                    </option>
                </x-select-input>
                <x-input-error :messages="$errors->get('currency')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="coin_price">
                    {{ __('Coin Price') }} <span class="text-red-500">*</span>
                </x-input-label>
                <div class="relative">
                    <div class="absolute inset-y-0 end-0 flex items-center pe-8 pointer-events-none">
                        <span class="text-gray-500 dark:text-gray-400" x-text="currency"></span>
                    </div>
                    <x-text-input id="coin_price" class="mt-1 block w-full" type="number" name="coin_price"
                        :value="old('coin_price', $setting->coin_price)" autocomplete="coin_price" required step="0.01" min="0.01" />
                </div>
                <x-input-error :messages="$errors->get('coin_price')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email">
                    {{ __('Email') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                    :value="old('email', $setting->email)" autocomplete="email" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone">
                    {{ __('Phone') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="phone" class="mt-1 block w-full" type="text" name="phone"
                    :value="old('phone', $setting->phone)" autocomplete="phone" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="telegram" :value="__('Telegram')" />
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <div class="text-gray-500 dark:text-gray-400">@</div>
                    </div>
                    <x-text-input id="telegram" class="mt-1 block w-full ps-10" type="text" name="telegram"
                        :value="old('telegram', $setting->telegram)" autocomplete="telegram" placeholder="username" />
                </div>
                <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="whatsapp" :value="__('WhatsApp')" />
                <x-text-input id="whatsapp" class="mt-1 block w-full" type="text" name="whatsapp"
                    :value="old('whatsapp', $setting->whatsapp)" autocomplete="whatsapp" placeholder="" />
                <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="whmain_headeratsapp" :value="__('Main Header')" />
                <textarea id="main_header" name="main_header" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" required>{{ old('main_header', $setting->main_header) }}</textarea>
                <x-input-error :messages="$errors->get('main_header')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="custom_css" :value="__('Custom CSS')" />
                <textarea id="custom_css" name="custom_css" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="" required>{{ old('custom_css', $setting->custom_css) }}</textarea>
                <x-input-error :messages="$errors->get('custom_css')" class="mt-2" />
            </div>

            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </form>
        <script>
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
