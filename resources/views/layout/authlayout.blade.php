<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Include CSS files -->
    <link rel="stylesheet" href="{{ URL::asset('build/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('build/css/style.css') }}">
    <!-- Include other CSS files as needed -->
</head>

<body class="account-page">
    <div class="main-wrapper">
        @yield('content')
    </div>

    <!-- Include JS files -->
    <script src="{{ URL::asset('build/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Include other JS files as needed -->
</body>

</html>
