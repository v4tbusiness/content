<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Payment') }}
        </h2>
    </x-slot>

    <div class="max-w-xl">
        <form method="post" action="{{ route('payments.update', $payment->id) }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="payment_method">
                    {{ __('Payment Method') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="payment_method" class="mt-1 block w-full" type="text" name="payment_method"
                    :value="old('payment_method', $payment->payment_method)" autofocus autocomplete="payment_method" required />
                <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="instructions">
                    {{ __('Instructions') }} <span class="text-red-500">*</span>
                </x-input-label>
                <div class="mt-1 block w-full">
                    <x-text-editor>
                        <input type="hidden" id="wysiwyg-hiddenInput" name="instructions"
                            value="{{ old('instructions', $payment->instructions) }}" />
                        <div
                            id="wysiwyg"class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400">
                        </div>
                    </x-text-editor>
                </div>
                <x-input-error :messages="$errors->get('instructions')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="minimum_transaction">
                    {{ __('Minimum Transaction') }} <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="minimum_transaction" class="mt-1 block w-full" type="number"
                    name="minimum_transaction" :value="old('minimum_transaction', $payment->minimum_transaction)" autocomplete="minimum_transaction" required
                    step="0.01" min="0.01" />
                <x-input-error :messages="$errors->get('minimum_transaction')" class="mt-2" />
            </div>

            <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </form>
    </div>

</x-admin-layout>
