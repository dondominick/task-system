<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        #body {
            background-image: url({{ asset('assets/images/background-login.jpeg') }});

        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased ">
    <div id="body"
        class="bg-cover bg-bottom bg-fixed bg-no-repeat min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-red-100 dark:bg-gray-900">


        <div
            class="flex w-full h-[550px]  sm:max-w-[1000px] mt-6  bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex basis-1/2">
                <img class="object-cover object-center" src="{{ asset('assets/images/login-page.jpeg') }}"
                    alt="">
            </div>
            <div class="basis-1/2 p-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
