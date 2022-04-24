<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/settings/password">
            @csrf

            <!-- current Password -->
            <div class="mt-4">
                <x-label for="currentPassword" :value="__('Aktuelles Password')" />

                <x-input id="currentPassword" class="block mt-1 w-full" type="password" name="currentPassword" required
                    autocomplete="current-password" />
            </div>

            <!-- new Password -->
            <div class="mt-4">
                <x-label for="newPassword" :value="__('Neues Password')" />

                <x-input id="newPassword" class="block mt-1 w-full" type="password" name="newPassword" required
                    autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Password ändern') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
