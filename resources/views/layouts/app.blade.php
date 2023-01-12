<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@skyrealmde">
        <meta name="twitter:title" content="SkyRealmDE">
        <meta name="twitter:description" content="SkyRealm ist ein deutscher SkyBlock Server, mit Fokus auf die neusten Minecraft Java-Edition Versionen.">
        <meta name="twitter:image" content="https://skyrealm.de/assets/banner.png">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Rubik:wght@400;700;900&family=Sono&display=swap" rel="stylesheet">
        <link href="https://cdn.sellix.io/static/css/embed.css" rel="stylesheet"/>

        <!-- Scripts -->
        <script src="https://icons.flawcra.cc/get.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.sellix.io/static/js/embed.js"></script>
    </head>
    <body class="font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white antialiased">
        <x-navigation />

        <div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-[90%] mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
