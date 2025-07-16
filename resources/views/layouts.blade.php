<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
<main id="main-content" class="flex-1">
    @yield('content')
</main>

@if (!request()->is('debt'))
    @include('components.bottom-nav')
@endif

<script src="https://telegram.org/js/telegram-web-app.js"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


</body>
</html>


