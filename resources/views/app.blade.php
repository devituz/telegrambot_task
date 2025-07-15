<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{secure_asset('css/style.css')}}">

</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-sm mx-auto bg-white min-h-screen relative">

    <div id="home-page" class="page active">
        @include('Home')

    </div>
    <div id="groups-page" class="page">
        @include('Group')

    </div>
{{--    <div id="groups-page" class="page">--}}
{{--        @include('Debt')--}}

{{--    </div>--}}
    <div id="settings-page" class="page">
        @include('Settings')

    </div>
    @include('Navigation')
</div>


<script src="https://telegram.org/js/telegram-web-app.js"></script>
<script src="{{secure_asset('js/scripts.js')}}"></script>

</body>
</html>
