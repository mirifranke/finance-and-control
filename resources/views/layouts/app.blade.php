@props(['heading'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="border-b border-gray-300">
            <div class="max-w-7xl mx-auto py-1 md:py-4 px-2 md:px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase tracking-widest">
                    {{ $heading }}
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="md:py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="sm:rounded-lg p-2 md:p-6 bg-white">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-data="{ show: false, message: 'Default Message' }"
         x-show.transition.opacity="show"
         x-text="message"
         @flash.window="
            message = $event.detail.message;
            show = true;
            setTimeout(() => show = false, 1000);
        "
         class="fixed bottom-0 right-0 bg-green-500 text-white p-2 m-4 rounded-xl">
    </div>

    <script>
        function flash(message) {
            window.dispatchEvent(new CustomEvent('flash', {
                detail: {
                    message
                }
            }));
        }
    </script>

    <x-flash />
    @livewireScripts
</body>

</html>
