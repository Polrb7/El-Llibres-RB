<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>El Llibres</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body
    class="bg-gradient-to-br from-blue-800 via-white to-gray-800 text-gray-800 dark:bg-gradient-to-bl dark:from-blue-600 dark:via-gray-900 dark:to-gray-600 dark:text-gray-200 font-figtree relative min-h-screen">
    <!-- Header -->
    <header class="relative z-10 grid grid-cols-2 items-center gap-4 px-6 py-8 lg:grid-cols-3">
        <!-- Logo -->
        <div class="flex justify-start lg:justify-center lg:col-start-2">
            <x-application-logo class="block h-16 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </div>

        <!-- Navegació -->
        @if (Route::has('login'))
        <nav class="flex flex-1 justify-end space-x-4">
            @auth
            <!-- Dashboard -->
            <a href="{{ route('view.allbooks') }}"
                class="rounded-md px-4 py-2 text-md font-medium text-black transition hover:text-black/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
            </a>
            @else
            <!-- Login -->
            <a href="{{ route('login') }}"
                class="rounded-md px-4 py-2 text-md font-medium text-black transition hover:text-black/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in
            </a>

            <!-- Register -->
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="rounded-md px-4 py-2 text-md font-medium text-black transition hover:text-black/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Register
            </a>
            @endif
            @endauth
        </nav>
        @endif
    </header>

    <!-- Contingut principal -->
    <main class="relative z-10 flex flex-col items-center px-6 py-12 mt-28 text-center">
        <div class="container mx-auto">
            <!-- Títol -->
            <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 sm:text-5xl">
                Benvingut a <span class="">El Llibres</span>
            </h1>
            <!-- Descripció -->
            <p class="mt-8 text-xl font-semibold text-gray-600 dark:text-gray-300">
                La millor plataforma per descobrir, compartir i gaudir dels llibres que t'apassionen.
            </p>

            <!-- Botó -->
            <a href="{{ route('view.allbooks') }}"
                class="mt-8 inline-flex items-center rounded-full bg-blue-500 px-8 py-3 text-lg font-semibold text-white shadow-lg transition-transform transform hover:scale-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF2D20] dark:shadow-2xl">
                <span>Explora els llibres</span>
            </a>
        </div>
    </main>
</body>

</html>