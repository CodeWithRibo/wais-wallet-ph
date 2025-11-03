<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Wais Wallet PH</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <!-- Script -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white">
<header class="shadow">
    <nav x-data="{ open: false }" class=" max-w-7xl mx-auto px-5">
        <div class="hidden sm:flex items-center justify-between py-5">
            <div class="flex items-center space-x-3">
                        <span class="bg-[#00AF74] py-1 px-1 rounded-md">
                            <x-ui.icon name="ps:currency-dollar" class="text-white size-5"/>
                        </span>
                <h1 class="text-gray-800 text-base">Wais Wallet PH</h1>
            </div>
            <div class="space-x-3">
                <a href="{{route('login')}}">
                    <x-secondary-button class="py-2 px-4 border-none shadow-  hover:bg-green-50 hover:text-green-600">
                        Login
                    </x-secondary-button>
                </a>
                <x-secondary-button
                    class="py-2 px-4 border-green-400 text-green-600 hover:bg-green-50 hover:text-gray-800 ">Contact Us
                </x-secondary-button>
            </div>
        </div>

        <div class="flex items-center justify-between py-5 sm:py-0">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <span class="bg-[#00AF74] py-1 px-1 rounded-md  sm:hidden">
                      <x-ui.icon name="ps:currency-dollar" class="text-white size-5"/>
                </span>
            </div>
            <!--Hamburger Menu-->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>


        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')"
                                       wire:navigate>
                    {{ __('Login') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')"
                                       wire:navigate>
                    {{ __('Register') }}
                </x-responsive-nav-link>

            </div>
        </div>
    </nav>
</header>
<section class="max-w-7xl mx-auto px-5 py-20 relative">
    <div class="absolute top-[-1rem] left-[-5rem] w-96 h-96 bg-emerald-200 rounded-full  blur-3xl opacity-20">
    </div>
    <div class="text-black space-y-5 z-50 relative">
        <p>
            Take control of your budget — the <span class="text-green-600">Wais</span> way.
        </p>
        <p class="w-[42%] text-gray-500">
            Your smart companion for managing everyday expenses. Built for Filipinos who want simplicity and control in
            personal finance.
        </p>

        <div class="space-x-5">
            <x-secondary-button class="py-2 px-5">Get Started</x-secondary-button>
            <x-secondary-button class="py-2 px-5">Learn More</x-secondary-button>
        </div>
    </div>
</section>
</body>
</html>
