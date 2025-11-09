<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
<main class="min-h-screen bg-white">
    <header class="shadow">
        <nav x-data="{ open: false }" class=" max-w-7xl mx-auto px-5">
            <div class="hidden sm:flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="{{asset('wais-wallet-logo-v2.png')}}" class="w-[15%] h-[15%]" alt="wais_wallet_logo"
                         srcset="">
                    <h1 class="text-gray-800 text-base">Wais Wallet PH</h1>
                </div>
                <div class=" flex items-center space-x-3">
                    @auth
                        <form action="{{route('logout-account')}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="py-2 px-4  text-black hover:bg-green-50 rounded-lg hover:text-green-600 transition-all duration-300">
                                Logout
                            </button>
                        </form>
                    @endauth
                    @guest
                        <a href="{{route('login')}}"
                           class="py-2 px-4  text-black hover:bg-green-50 rounded-lg hover:text-green-600 transition-all duration-300">
                            Login
                        </a>
                    @endguest
                    <button
                        class="btn btn-outline border-emerald-600 font-light text-green-600 hover:text-black hover:bg-emerald-50 hover:shadow-none transition-all duration-300 px-4 rounded-lg"
                    >Contact Us
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between py-5 sm:py-0">
                <!-- Logo -->
                <img src="{{asset('wais-wallet-logo-v2.png')}}" class="sm:hidden w-[15%] h-[15%]" alt="wais_wallet_logo"
                     srcset="">
                <!--Hamburger Menu-->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round"
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
    <section class="max-w-7xl mx-auto px-5 py-20 relative grid grid-cols-1 space-y-20 lg:grid-cols-2 lg:space-y-0 ">
        <div>
            <div class="absolute top-[-1rem] left-[-5rem] w-96 h-96 bg-emerald-200 rounded-full  blur-3xl opacity-20">
            </div>
            <div class="text-black space-y-5 z-50 relative">
                <p>
                    Take control of your budget — the <span class="text-green-600">Wais</span> way.
                </p>
                <p class="w-[70%] text-gray-500">
                    Your smart companion for managing everyday expenses. Built for Filipinos who want simplicity and
                    control
                    in
                    personal finance.
                </p>

                <div class="space-x-5">
                    <a href="{{route('login')}}">
                        <button
                            class="btn bg-emerald-600 hover:bg-emerald-700 font-light border-none rounded-md px-8 cursor-pointer "
                        >Get Started
                        </button>
                    </a>
                    <button
                        class="btn btn-outline border-emerald-600 font-light text-green-600 hover:text-black hover:bg-emerald-50 hover:shadow-none transition-all duration-300 px-8"
                    >Learn More
                    </button>
                </div>

                <div class="flex items-center space-x-7 mt-10">
                  <span class="flex items-center space-x-3">
                    <span class="bg-green-100 px-3 py-2 w-10 h-10 rounded-full flex items-center">
                        <x-ui.icon name="ps:check" variant="bold" class="size-5 text-green-600"/>
                    </span>
                    <h1 class="text-gray-500 text-sm">100% Secure</h1>
                  </span>

                    <span class="flex items-center space-x-3">
                    <span class="bg-green-100 px-3 py-2 w-10 h-10 rounded-full flex items-center">
                        <x-ui.icon name="ps:lock" variant="bold" class="size-5 text-green-600"/>
                    </span>
                    <h1 class="text-gray-500 text-sm">Privacy First</h1>
                  </span>

                </div>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <div class="relative w-[60%] lg:w-[70%]">
                <div class="absolute top-[-1rem] left-[1.5rem] w-[95%] h-[50%] bg-emerald-200 z-0 blur-2xl opacity-100">
                </div>
                <div
                    class="flex space-x-5 py-4  px-3 rounded-xl shadow-xl bg-white absolute left-[-6rem] top-[-1rem] z-50">
                <span class="bg-green-100 px-3 py-2 rounded-2xl flex items-center">
                    <p>💰</p>
                </span>
                    <span class="text-black">
                    <p class="text-gray-300 text-sm">Total Savings</p>
                    <p class="text-green-600">₱12,450</p>
                </span>
                </div>

                <div
                    class="flex space-x-5 py-4  px-3 rounded-xl shadow-xl bg-white absolute bottom-[-1rem] right-[-2rem]  z-50">
                <span class="bg-blue-100 px-3 py-2 rounded-2xl flex items-center">
                    <p>📊</p>
                </span>
                    <span class="text-black">
                    <p class="text-gray-300 text-sm">This Month</p>
                    <p class="text-blue-600">+23%</p>
                </span>
                </div>

                <div class="bg-white px-10 py-10 rounded-2xl shadow-2xl relative z-10">
                    <div class="flex justify-center items-center  rounded-2xl bg-gray-100 py-3">
                        <img src="{{asset('accounting_image.png')}}" class="w-[15%]" alt="blank_image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="max-w-7xl mx-auto mt-10 sm:pt-0 ">
        <footer class="footer sm:footer-horizontal  text-gray-500 items-center p-4">
            <div class="flex items-center">
                <img src="{{asset('wais-wallet-logo-v2.png')}}" class="w-[15%] h-[15%]" alt="wais_wallet_logo"
                     srcset="">
                <p>Copyright © Wais Wallet PH {{\Carbon\Carbon::now()->year }} - All right reserved</p>
            </div>
            <nav class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
                <a>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        class="fill-current hover:text-emerald-600">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                    </svg>
                </a>
                <a href="https://www.youtube.com/@riboluna" target="_blank">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        class="fill-current hover:text-emerald-600">
                        <path
                            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                    </svg>
                </a>
                <a href="https://www.facebook.com/carljohn2818/" target="_blank">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        class="fill-current hover:text-emerald-600">
                        <path
                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                    </svg>
                </a>
            </nav>
        </footer>
    </footer>
</main>
</body>
</html>
