<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CORE :: Herald</title>

    <link rel="stylesheet" type="text/css"  href="{{ mix('/css/app.css') }}">
    @stack('css')

</head>

<body>

<div class="container-fluid" id="app">
    @yield('content')
</div>


<script src="{{ mix('/js/app.js') }}"></script>
@stack('js')

</body>
</html>