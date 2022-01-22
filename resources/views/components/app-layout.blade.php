<div>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @livewireStyles
        @livewireScripts
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="w-screen h-screen overflow-y-scroll container mx-auto bg-gray-200 py-10">
        {{ $slot }}
    </body>

    </html>
</div>
