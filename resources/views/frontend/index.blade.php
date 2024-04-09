<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @include('frontend.layouts.header')
</head>

<body>
    <!--=============== HEADER ===============-->
    @include('frontend.layouts.navbar')
    <!--------------------------------------------------------------------->


    {{-- Content --}}
        @yield('content')
    {{-- !Content --}}

    <!-- -------------------------------------- -->
    <!-- footer -->
    @include('frontend.layouts.footer')

    {{-- Scripts --}}
    @include('frontend.layouts.scripts')
</body>

</html>
