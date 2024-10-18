<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/momekano.png') }}" type="image/x-icon">
    <title>{{ $title ?? 'Momekano' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div id="loginUser"
        class="bg-cover bg-center min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-700 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
<script>
    function getDarkMode() {
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    }

    // Applique le style en fonction du mode du navigateur
    function applyDarkMode() {
        const loginUser = document.getElementById('loginUser');
        if (getDarkMode()) {
            loginUser.classList.remove('light');
            loginUser.classList.add('dark');
        } else {
            loginUser.classList.remove('dark');
            loginUser.classList.add('light');
        }
    }

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyDarkMode);
    applyDarkMode();
</script>

</html>
