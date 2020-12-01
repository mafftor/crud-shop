<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CRUD Shop - {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
        .required label::after {
            content: ' *';
            color: red;
        }
    </style>
</head>
<body>

@include('shared.nav')
<div class="container mt-5">
    @include('shared.flash-message')

    @yield('content')
</div>

<script src="https://kit.fontawesome.com/cd1c0e7489.js" crossorigin="anonymous"></script>
</body>
</html>
