<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wais Wallet PH</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white">
            <header>
                <nav class="flex items-center justify-between px-10">
                    <div class="flex items-center">
                        <x-application-logo class="w-18 "/>
                        <h1 class="text-gray-800">Wais Wallet PH</h1>
                    </div>
                    <div class="space-x-3">
                        <a href="{{route('login')}}">
                            <x-secondary-button class="py-2 px-4 border-none shadow-  hover:bg-green-50 hover:text-green-600">Login</x-secondary-button>
                        </a>
                        <x-secondary-button class="py-2 px-4 border-green-400 text-green-600 hover:bg-green-50 hover:text-gray-800 ">Contact Us</x-secondary-button>
                    </div>
                </nav>
            </header>
    </body>
</html>
