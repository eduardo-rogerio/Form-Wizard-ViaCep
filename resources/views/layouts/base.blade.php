<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')

        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body x-data="{mode:'dark'}" :class="mode === 'dark' ? 'dark bg-gray-800':'light bg-white'">
<div class="max-w-2xl mx-auto p-16 bg-white dark:bg-gray-800">
    <div class="flex items-end justify-end">
        <x-dynamic-component
            @click="mode = 'light'"
            x-show="mode === 'dark'"
            component="heroicon-s-sun"
            class="w-7 text-white cursor-pointer"
        ></x-dynamic-component>
        <x-dynamic-component
            @click="mode = 'dark'"
            x-show="mode === 'light'"
            component="heroicon-s-moon"
            class="w-7 text-gray-800 cursor-pointer"
        ></x-dynamic-component>
    </div>
    @yield('body')
</div>
</body>
</html>
