<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel-Angular JS | @yield('title')</title>
    <style>
        .header {
            background-color: green;
            color: white;
            text-align: center;
        }
        .footer {
            background-color: blue;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- header start -->
    @include('layouts.partials.header')
    <!-- header end -->

    <!-- content -->
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>   
    <!-- End content -->

    <!-- footer start -->
    @include('layouts.partials.footer')
    <!-- footer end -->
</body>
</html>