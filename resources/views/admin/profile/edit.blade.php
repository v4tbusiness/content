<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="max-w-xl">
            @include('admin.profile.partials.update-profile-information-form')
        </div>
        <div class="max-w-xl">
            @include('admin.profile.partials.update-password-form')
        </div>
        <div class="max-w-xl ">
            @include('admin.profile.partials.delete-user-form')
        </div>
    </div>
</x-admin-layout>
