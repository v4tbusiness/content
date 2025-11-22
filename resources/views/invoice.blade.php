<x-invoice-layout>

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
        <meta property="og:title" content="{{ $setting->site_name }} - Invoice">
        <meta property="og:description" content="{{ $setting->site_description }}">
        <meta property="og:image" content="{{ asset($setting->logo) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $setting->site_name }} - Invoice">
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
                  "name": "Invoice",
                  "item": "{{ url()->current() }}"
                }
              ]
            }
        </script>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm py-6" id="invoice">
        <div class="grid grid-cols-2 items-center">
            <div>
                <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name }}" class="h-24">
            </div>
            <div class="text-right">
                <div>{{ $setting->site_name }}</div>
                <div class="text-gray-500 text-sm">{{ $setting->email }}</div>
                <div class="text-gray-500 text-sm mt-1">{{ $setting->phone }}</div>
                {{-- <div class="text-gray-500 text-sm mt-1">VAT: XXXXXXXXXX</div> --}}
            </div>
        </div>

        <div class="grid grid-cols-2 items-center mt-8">
            <div>
                <div class="font-bold text-gray-800">Bill to :</div>
                {{-- <div class="text-gray-500">Laravel LLC.<br />102, San-Fransico, CA, USA</div> --}}
                <div class="text-gray-500">{{ $transaction->user->name }}</div>
            </div>
            <div class="text-right">
                @if ($transaction->proof || $transaction->notes)
                    @if ($transaction->status === 'pending')
                        <div>Status: <span class="text-blue-500">process</span>
                        </div>
                    @endif
                    @if ($transaction->status === 'approved')
                        <div>Status: <span class="text-green-500">{{ $transaction->status }}</span>
                        </div>
                    @endif
                    @if ($transaction->status === 'rejected')
                        <div>Status: <span class="text-red-500">{{ $transaction->status }}</span>
                        </div>
                    @endif
                @else
                    @if ($transaction->status === 'pending')
                        <div>Status: <span class="text-yellow-500">{{ $transaction->status }}</span>
                        </div>
                    @endif
                    @if ($transaction->status === 'approved')
                        <div>Status: <span class="text-green-500">{{ $transaction->status }}</span>
                        </div>
                    @endif
                    @if ($transaction->status === 'rejected')
                        <div>Status: <span class="text-red-500">{{ $transaction->status }}</span>
                        </div>
                    @endif
                @endif
                <div>Invoice date: <span class="text-gray-500">{{ $transaction->created_at->format('d/m/Y') }}</span>
                    <br />Due date: <span
                        class="text-gray-500">{{ $transaction->created_at->clone()->addDay()->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <table class="min-w-full">
                <colgroup>
                    <col class="w-full sm:w-2/3">
                    <col class="sm:w-1/6">
                    <col class="sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Items</th>
                        <th scope="col"
                            class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900 table-cell">
                            Amount</th>
                        <th scope="col"
                            class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                            <div class="font-medium text-gray-900">Coins</div>
                            {{-- <div class="mt-1 truncate text-gray-500"></div> --}}
                        </td>
                        <td class="px-3 py-5 text-right text-sm text-gray-500 table-cell">{{ $transaction->amount }}
                        </td>
                        <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">
                            {{ $setting->currency_symbol }}&nbsp;{{ $transaction->price }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="2"
                            class="pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:pl-0">Subtotal</th>
                        <td class="pl-3 pr-4 pt-6 text-right text-sm text-gray-500 sm:pr-0">
                            {{ $setting->currency_symbol }}&nbsp;{{ $transaction->price }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2"
                            class="pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:pl-0">Tax</th>
                        <td class="pl-3 pr-4 pt-4 text-right text-sm text-gray-500 sm:pr-0">
                            {{ $setting->currency_symbol }}&nbsp;0</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2"
                            class="pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:pl-0">Payment Method
                        </th>
                        <td class="pl-3 pr-4 pt-4 text-right text-sm text-gray-500 sm:pr-0 whitespace-nowrap">
                            {{ $transaction->payment->payment_method }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2"
                            class="pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:pl-0">Total</th>
                        <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">
                            {{ $setting->currency_symbol }}&nbsp;{{ $transaction->price }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="pt-4 text-gray-500 mt-6">
            @if ($transaction->status === 'pending')
                @if ($transaction->proof || $transaction->notes)
                    <x-secondary-button class="w-full"
                        onclick="location.reload();">{{ __('Refresh') }}</x-secondary-button>
                @else
                    <p class="font-bold text-gray-800">Instructions :</p>
                    {!! $transaction->payment->instructions !!}
                    <form method="post" action="{{ route('updateInvoice', $transaction->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="proof">
                                {{ __('Proof of Payment') }} <span class="text-red-500">*</span>
                            </x-input-label>
                            <x-file-input id="proof" type="file" name="proof" class="mt-1 block w-full"
                                required />
                            <x-input-error :messages="$errors->get('proof')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="notes">
                                {{ __('Notes') }} <span class="text-gray-500">(optional)</span>
                            </x-input-label>
                            <x-text-input id="notes" class="mt-1 block w-full" type="text" name="notes"
                                :value="old('notes')" autocomplete="notes" />
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-primary-button class="sm:w-full">{{ __('Submit') }}</x-primary-button>
                        </div>
                    </form>
                    <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-12">
                        Please pay the invoice before the due date. You can pay the invoice by following the
                        instructions
                        provided.
                    </div>
                @endif
            @else
                <a href="{{ route('topup') }}"
                    class="block w-full text-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back
                    to Merchant</a>
            @endif
        </div>
    </div>

</x-invoice-layout>
